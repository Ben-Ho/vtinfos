Kwf.onJElementReady('.formsSpeakerFieldSuperBoxSelect', function (el) {
    var getSelection = function (el) {
        return JSON.parse($(el).find('.selection').val());
    }
    var setSelection = function (el, selection) {
        if (selection.length == 0) return;
        // Set selection to posted input-field
        $(el).find('.selection').val(JSON.stringify(selection));
        // clear displayed values
        $(el).find('.selectedValues').empty();

        for (var key in selection) {
            selection[key].sort(function (a, b) {
                return a - b;
            });
            var jsCode = '<div class="languageBlock">';
            var language = '';
            if (key == 'de') {
                language = trl('Deutsch');
            } else if (key == 'en') {
                language = trl('Englisch');
            } else if (key == 'fr') {
                language = trl('Französisch');
            } else if (key == 'zh') {
                language = trl('Chinesisch');
            } else if (key == 'fa') {
                language = trl('Persisch');
            } else if (key == 'gebaerde') {
                language = trl('Gebärdensprache');
            } else if (key == 'twi') {
                language = trl('Twi');
            } else if (key == 'ga') {
                language = trl('Ga');
            }
            jsCode += '<div class="languageName" data-code="'+key+'">'+language+'</div>';
            for (var i = 0; i < selection[key].length; i++) {
                jsCode += '<div class="selectedValue"><span class="value">'+selection[key][i]+'</span><span class="remove">X</span></div>';
            }
            jsCode += '</div>';
            $(el).find('.selectedValues')
                .append(jsCode);
        }
        // add listener to displayed values
        $(el).find('.selectedValue .remove').click(function (ev) {
            if (!confirm(trl('Möchtest du diesen Vortrag wirklich löschen? Änderung wird mit Speichern endgültig übernommen.')))
                return;
            var talkNumber = $(ev.currentTarget).parent('.selectedValue').find('.value').html();
            var language = $(ev.currentTarget).parent().parent().find('.languageName').data('code');
            var selection = getSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'));
            var newSelection = [];
            for (var i = 0; i < selection[language].length; i++) {
                if (selection[language][i] != talkNumber)
                    newSelection.push(selection[language][i]);
            }
            selection[language] = newSelection;
            setSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'), selection);
        });
    }
    // init displayed values
    setSelection(el, getSelection(el));
    // init add new value
    el.find('.addValue .button').click(function(ev) {
        var newValue = $(ev.currentTarget).closest('.addValue').find('.newValue').val();
        var language = $(ev.currentTarget).closest('.addValue').find('.newValueSelect').val();
        if (!newValue)
            return;
        $(ev.currentTarget).closest('.addValue').find('.newValue').val('');
        var selection = getSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'));
        if (selection[language] == undefined) {
            selection[language] = [];
        }
        var alreadyExisting = false;
        var newValue = parseInt(newValue);
        for (var i = 0; i < selection[language].length; i++) {
            if (selection[language][i] == newValue) {
                alreadyExisting = true;
                break;
            }
        }
        if (!alreadyExisting) selection[language].push(newValue);
        setSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'), selection);
    });
});
