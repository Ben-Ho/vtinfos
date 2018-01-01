import { createStore, applyMiddleware } from 'redux';
import createMiddlewares from './middlewares';
import rootReducer from './rootReducer';

export default function (initialState, config) {
    const middlewares = createMiddlewares(config);
    const createStoreWithMiddleware = applyMiddleware(...middlewares)(createStore);
    return createStoreWithMiddleware(rootReducer, initialState);
}
