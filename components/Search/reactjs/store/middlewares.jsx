import createLogger from 'redux-logger';
import thunk from 'redux-thunk';
import api from './api';
import { Iterable } from 'immutable';

export default function createMiddelwares(config) {
    let middlewares = [];

    middlewares.push(thunk.withExtraArgument(api));

    // Logger (only for Test)
    if (process.env.NODE_ENV == 'test') {
        middlewares.push(createLogger({
            collapsed: true,
            stateTransformer: (state) => {
                const newState = {};
                for (let i of Object.keys(state)) {
                    if (Iterable.isIterable(state[i])) {
                        newState[i] = state[i].toJS();
                    } else {
                        newState[i] = state[i];
                    }
                }
                return newState;
            }
        }));
    }

    return middlewares;
}
