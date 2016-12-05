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
                            '<div class="congregationSelect">' +
                                '<input placeholder="'+trl('Versammlungsname')+'" class="congregation awesomplete" type="text">' +
                            '</div>' +
                            '<div class="speakerSelect">' +
                                '<input placeholder="'+trl('Redner')+'" class="speaker awesomplete" type="text">' +
                            '</div>' +
                            '<div class="talkSelect">' +
                                '<input placeholder="'+trl('Vortrag')+'" class="talk awesomplete" type="text">' +
                            '</div>' +
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
            el.find('.congregation').each(function(index, congregationEl) {
                congregationEl.awesomplete = new Awesomplete(congregationEl, {
                    replace: function(selection) {
                        this.input.value = selection.label;
                        this.input.congregationId = selection.value;
                    }
                });
                congregationEl.awesomplete.on('awesomplete-selectcomplete', function() {
                    console.log('auswahl fertig');
                    console.log(arguments);
                });
            });
            el.find('.speaker').each(function(index, speakerEl) {
                speakerEl.awesomplete = new Awesomplete(speakerEl, {
                    replace: function(selection) {
                        this.input.value = selection.label;
                        this.input.speakerId = selection.value;
                    }
                })
            });
            el.find('.congregation').on('keyup', function(ev) {
                var congregationName = $(ev.currentTarget).val();
                // Damit u.a. pfeiltasten bei awesomplete funktioniert
                if (ev.currentTarget.lastValue && ev.currentTarget.lastValue == congregationName) {
                    return;
                }
                ev.currentTarget.lastValue = congregationName;
                if (congregationName.length < 4) return;

                $.ajax(config.congregationsUrl, {
                    data: {
                        congregationName: congregationName
                    },
                    success: function(response, result, options) {
                        response = $.parseJSON(response);
                        ev.currentTarget.awesomplete.list = response.congregations;
                    }
                });
            });
            el.find('.speaker').on('keyup', function(ev) {
                var congregationId = $(ev.currentTarget).closest('.week').find('congregation')[0].congregationId;
                var speakerName = $(ev.currentTarget).val();
                debugger;
                if (ev.currentTarget.lastValue && ev.currentTarget.lastValue == speakerName) {
                    return;
                }
                ev.currentTarget.lastValue = speakerName;
                $.ajax(config.speakersUrl, {
                    data: {
                        congregationId: ev.currentTarget.congregationId,
                        speakerName: speakerName
                    },
                    success: function(response, result, options) {
                        response = $.parseJSON(response);
                        ev.currentTarget.awesomplete.list = response.speakers;
                    }
                });
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
