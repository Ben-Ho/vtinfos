var onReady = require('kwf/commonjs/on-ready');
var $ = require('jQuery');

onReady.onRender('.formsSpeakerFieldSuperBoxSelect', function (el) {
    var getSelection = function (el) {
        return JSON.parse(el.find('.selection').val());
    }
    var setSelection = function (el, selection) {
        if (selection.length == 0) return;
        // Set selection to posted input-field
        el.find('.selection').val(JSON.stringify(selection));
        // clear displayed values
        el.find('.selectedValues').empty();

        for (var key in selection) {
            selection[key].sort(function (a, b) {
                return a - b;
            });
            var jsCode = '<div class="languageBlock">';
            var language = '';
            if (key == 'de') {
                language = __trl('Deutsch');
            } else if (key == 'en') {
                language = __trl('Englisch');
            } else if (key == 'fr') {
                language = __trl('Französisch');
            } else if (key == 'zh') {
                language = kwfkwfTrl.trl.__trl('Chinesisch');
            } else if (key == 'fa') {
                language = __trl('Persisch');
            } else if (key == 'gebaerde') {
                language = __trl('Gebärdensprache');
            } else if (key == 'twi') {
                language = __trl('Twi');
            } else if (key == 'ga') {
                language = __trl('Ga');
            } else if (key == 'tr') {
                language = __trl('Türkisch');
            } else if (key == 'sr') {
                language = __trl('Serbisch');
            } else if (key == 'ru') {
                language = __trl('Russisch');
            } else if (key == 'es') {
                language = __trl('Spanisch');
            } else if (key == 'ar') {
                language = __trl('Arabisch');
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
            if (!confirm(__trl('Möchtest du diesen Vortrag wirklich löschen? Änderung wird mit Speichern endgültig übernommen.')))
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
