import { Map, List, fromJS } from 'immutable';
import { createReducer} from 'redux-act';
import * as actions from './actions';

const initialState = Map({
    loading: false,
    results: List(),
    total: false
});

const receiveResults = (state, results) => {
    return state.merge({
        results: fromJS(results.data),
        loading: false,
        total: results.total
    });
};

const receiveMoreResults = (state, results) => {
    return state.merge({
        results: state.get('results').concat(fromJS(results.data)),
        loading: false
    });
};

const saveLastRequestParams = (state, params) => {
    return state.set('lastRequestParams', params);
};

const fetchingResults = (state) => {
    return state.merge({loading: true});
};

export default createReducer({
    [actions.receiveResults]: receiveResults,
    [actions.receiveMoreResults]: receiveMoreResults,
    [actions.saveLastRequestParams]: saveLastRequestParams,
    [actions.fetchingResults]: fetchingResults
}, initialState);
