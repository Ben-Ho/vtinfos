import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import trl from 'kwf/trl';
import * as actions from "../store/search/actions";
import Speaker from "./results/Speaker";

class Results extends Component {
    constructor(props) {
        super(props);
    }

    onLoadMoreClick() {
        if (this.props.loading) return;
        this.props.loadMore();
    }

    render() {
        const { speakers, loadMore, total, showLoadMoreButton, loading } = this.props;
        return (
            <div className={`kwfLocal kwfUp-webStandard ${loading && !speakers.size ? 'kwfLocal--loading' : ''}`}>
                {total && <div className="kwfLocal__count">{trl.trlp('Einen gefunden', '{0} gefunden', total)}</div>}
                <div className="kwfLocal__speakers">
                    {speakers.map((speaker) => (
                        <Speaker key={speaker.get('id')} speaker={speaker} />
                    ))}
                </div>
                {showLoadMoreButton && <div className={`kwfLocal__more ${loading && speakers.size ? 'kwfLocal__more--loading' : ''}`} onClick={() => this.onLoadMoreClick() }>{!loading && trl.trl('Mehr laden')}</div>}
            </div>
        );
    }
}

function mapStateToProps(state, ownProps) {
    const { search } = state;
    let showLoadMoreButton = search.get('total') ? search.get('total') != search.get('results').size : false;
    return {
        speakers: search.get('results'),
        total: search.get('total'),
        showLoadMoreButton: showLoadMoreButton,
        loading: search.get('loading')
    };
}

const mapDispatchToProps = (dispatch) => {
    return {
        loadMore: () => {
            dispatch(actions.fetchMoreResults());
        }
    };
};

const Connector = connect(mapStateToProps, mapDispatchToProps)(Results);

Connector.propTypes = {
};

export default Connector;
