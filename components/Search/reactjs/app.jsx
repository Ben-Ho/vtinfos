import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';

import Master from './components/Master';

import configureStore from './store';

export function render(domElement, config) {
    const loadingEl = domElement.previousElementSibling;
    const store = configureStore({
        settings: config.settings,
        talkLanguages: config.talkLanguages,
        circleGroups: config.circleGroups
    }, config.settings);

    ReactDOM.render(
        <Provider store={store}>
            <Master/>
        </Provider>,
        domElement,
        () => {
            loadingEl.parentElement.removeChild(loadingEl); //IE11 doesnt support elem.remove()
        }
    );
}
