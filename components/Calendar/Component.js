Kwf.onJElementReady('.cssClass', function(el) {
    var config = el.data('config');
    var startDate = new Date();
    var params = {
        startDate: startDate.format('Y-m-d')
    };
    $.ajax({
        url: config.controllerUrl,
        data: params,
        success: function(response, result, options) {
            el.empty();
            response = $.parseJSON(response);
            for (var i = 0; i < response.weeks.length; i++) {
                el.append(
                    '<div class="week" data-week="'+response.weeks[i].date+'">' +
                        '<div class="monday">'+ response.weeks[i].monday+'</div>' +
                        '<div class="data">' +
                            '<div class="speaker">'+ response.weeks[i].speaker+'</div>' +
                            '<div class="talk">'+ response.weeks[i].talk+'</div>' +
                        '</div>' +
                        '<div class="edit"></div>' +
                        '<div class="editRegion">' +
                            '<div class="congregationSelect"><input placeholder="'+trl('Versammlungsname')+'" class="congregation" type="text">' +
                                '<select class="congregations"><option disabled selected value>'+trl('Versammlung')+'</option></select>' +
                            '</div>' +
                            '<div class="speaker"><select class="speakers"><option disabled selected value>'+trl('Redner')+'</option></select></div>' +
                            '<div class="talk"><select class="talks"><option disabled selected value>'+trl('Vortrag')+'</option></select></div>' +
                        '</div>' +
                    '</div>'
                );
            }
            el.find('.edit').on('click', function(ev) {
                var currentEl = $(ev.currentTarget).closest('.week');
                if (currentEl.hasClass('editEntry')) {
                    currentEl.removeClass('editEntry');
                    if (!currentEl.find('.speakers').val()
                        || !currentEl.find('.talks').val()
                    ) {
                        return;
                    }
                    $.ajax({
                        url: config.controllerUrl+'/save',
                        data: {
                            speakerId: currentEl.find('.speakers').val(),
                            talkId: currentEl.find('.talks').val(),
                            week: currentEl.data('week')
                        },
                        success: function(response, result, options) {
                            response = $.parseJSON(response);
                            console.log('hier');
                            var weekEl = $(ev.currentTarget).closest('.week');
                            weekEl.find('.monday').html(response.week.monday);
                            weekEl.find('.speaker').html(response.week.speaker);
                            weekEl.find('.talk').html(response.week.talk);
                        }
                    });
                } else {
                    currentEl.addClass('editEntry');
                }
            });
            el.find('.congregation').on('keyup', function(ev) {
                var congregationName = $(ev.currentTarget).val();
                if (congregationName.length < 4) return;

                $.ajax(config.congregationsUrl, {
                    data: {
                        congregationName: congregationName
                    },
                    success: function(response, result, options) {
                        response = $.parseJSON(response);
                        var congregationSelect = $(ev.currentTarget).closest('.editRegion').find('.congregations');
                        congregationSelect.empty();
                        for (var i = 0; i < response.congregations.length; i++) {
                            congregationSelect.append(
                                '<option value="'+response.congregations[i].id+'">'
                                    +response.congregations[i].name+
                                '</option>'
                            );
                        }
                        if (response.congregations.length >= 1) {
                            loadSpeakers(response.congregations[0].id, $(ev.currentTarget).closest('.editRegion'));
                        }
                    }
                });
            });
            var loadSpeakers = function(congregationId, element) {
                $.ajax(config.speakersUrl, {
                    data: {
                        congregationId: congregationId
                    },
                    success: function(response, result, options) {
                        response = $.parseJSON(response);
                        var speakersSelect = element.find('.speakers');
                        speakersSelect.empty();
                        for (var i = 0; i < response.speakers.length; i++) {
                            speakersSelect.append(
                                '<option value="'+response.speakers[i].id+'">'
                                    +response.speakers[i].name+
                                '</option>'
                            );
                        }
                        if (response.speakers.length >= 1) {
                            loadTalks(response.speakers[0].id, element);
                        }
                    }
                });
            };
            el.find('.congregations').on('change', function(ev) {
                loadSpeakers($(ev.currentTarget).val(), $(ev.currentTarget).closest('.editRegion'));
            });
            var loadTalks = function(speakerId, element) {
                $.ajax(config.talksUrl, {
                    data: {
                        speakerId: speakerId,
                    },
                    success: function(response, result, options) {
                        response = $.parseJSON(response);
                        var talksSelect = element.find('.talks');
                        talksSelect.empty();
                        for (var i = 0; i < response.talks.length; i++) {
                            talksSelect.append(
                                '<option value="'+response.talks[i].id+'">'
                                    +response.talks[i].number+' '+response.talks[i].title+
                                '</option>'
                            );
                        }
                    }
                });
            };
            el.find('.speakers').on('change', function(ev) {
                loadTalks($(ev.currentTarget).val(), $(ev.currentTarget).closest('.editRegion'));
            });
        }
    });
});
