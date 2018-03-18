import './Master.scss';
import React from 'react';
import PropTypes from 'prop-types';
import Search from '../components/Search';
import Results from '../components/Results';

const Master = ({}) => (
    <div className="kwfLocal">
        <Search />
        <Results />
    </div>
);

Master.propTypes = {
};
export default Master;
