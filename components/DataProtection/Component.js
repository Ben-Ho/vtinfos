Kwf.onJElementReady('.cssClass', function(el, config) {
    if (config.dataProtectionAccepted) {
        el.remove();
    }
    el.find('button.later').on('click', function() {
        el.remove();
    });
});
