'use strict';
const WebpackConfig = require('webpack-config');

module.exports = new WebpackConfig.Config().extend(
    'kwf-webpack/config/webpack.kwc.config.js'
).merge({

    module: {
        rules: [{
            test: /\.jsx$/,
            exclude: /node_modules/,
            loader: 'babel-loader',
            options: {
                presets: [
                    ['env', {
                        'targets': {
                            'browsers': ['>0.4% in alt-EU']
                        }
                    }],
                    'react'
                ]
            }
        }]
    },
    resolve: {
        extensions: ['.jsx']
    }
});
