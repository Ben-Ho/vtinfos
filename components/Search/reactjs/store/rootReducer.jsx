import { combineReducers } from 'redux';
import { Map } from 'immutable';

import search from './search/reducer';

export default combineReducers({
    settings(state = Map(), action) {
        return state;
    },
    talkLanguages(state = {}, action) {
        return state;
    },
    circleGroups(state = {}, action) {
        return state;
    },
    search
});

