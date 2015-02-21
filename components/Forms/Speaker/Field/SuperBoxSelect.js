Kwf.onJElementReady('.formsSpeakerFieldSuperBoxSelect', function (el) {
    var getSelection = function (el) {
        return JSON.parse($(el).find('.selection').val());
    }
    var setSelection = function (el, selection) {
        // Set selection to posted input-field
        selection.sort(function (a, b) {
            return a - b;
        });
        $(el).find('.selection').val(JSON.stringify(selection));
        // clear displayed values
        $(el).find('.selectedValues').empty();
        // insert values from selection
        for (var i = 0; i < selection.length; i++) {
            $(el).find('.selectedValues')
                .append('<div class="selectedValue"><span class="value">'+selection[i]+'</span><span class="remove">X</span></div>')
        }
        // add listener to displayed values
        $(el).find('.selectedValue .remove').click(function (ev) {
            if (!confirm(trl('Möchtest du diesen Vortrag wirklich löschen? Änderung wird mit Speichern endgültig übernommen.')))
                return;
            var talkNumber = $(ev.currentTarget).parent('.selectedValue').find('.value').html();
            var selection = getSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'));
            var newSelection = [];
            for (var i = 0; i < selection.length; i++) {
                if (selection[i] != talkNumber)
                    newSelection.push(selection[i]);
            }
            setSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'), newSelection);
        });
    }
    // init displayed values
    setSelection(el, getSelection(el));
    // init add new value
    el.find('.addValue .button').click(function(ev) {
        var newValue = $(ev.currentTarget).closest('.addValue').find('.newValue').val();
        if (!newValue)
            return;
        $(ev.currentTarget).closest('.addValue').find('.newValue').val('');
        var selection = getSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'));
        selection.push(parseInt(newValue));
        setSelection($(ev.currentTarget).closest('.formsSpeakerFieldSuperBoxSelect'), selection);
    });
});
