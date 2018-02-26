import { createAction } from 'redux-act';

export const fetchingResults = createAction('Fetching Results');
export const receiveResults = createAction('Receive Results');
export const receiveMoreResults = createAction('Receive Results');

export const saveLastRequestParams = createAction('save last request params');

export const fetchResults = (params) => {
    return (dispatch, getState, api) => {
        dispatch(fetchingResults());

        params.language = getState().settings.language;
        api.get(`/api/v1/speakers/search`, {params: params})
            .then((response) => {
                dispatch(receiveResults(response.data));
            }, (ex) => {
                console.log('fetchResults exception');
                // problem occured
            });
    };
};

export const fetchMoreResults = () => {
    return (dispatch, getState, api) => {
        dispatch(fetchingResults());

        let lastRequestParams = getState().search.get('lastRequestParams');
        lastRequestParams.language = getState().settings.language;
        lastRequestParams.start = getState().search.get('results').size;
        api.get(`/api/v1/speakers/search`, {params: lastRequestParams})
            .then((response) => {
                dispatch(receiveMoreResults(response.data));
            }, (ex) => {
                console.log('fetchMoreResults exception');
                // problem occured
            });
    };
};
