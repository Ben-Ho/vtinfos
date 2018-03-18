import './Speaker.scss';
import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import trl from 'kwf/commonjs/trl';

class Speaker extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showTalks: false
        };
    }

    toggleTalks() {
        this.setState({
            showTalks: !this.state.showTalks
        });
    }

    render() {
        const { speaker } = this.props;
        const { showTalks } = this.state;
        return (
            <div className="kwfLocal kwfUp-webStandard">
                <div className="kwfLocal__name">
                    {speaker.get('lastname')} {speaker.get('firstname')} ({ speaker.get('degree') == 'e' && trl.trl('Ä')}{ speaker.get('degree') == 'm' && trl.trl('DAG')})
                </div>
                <div className="kwfLocal__congregation">
                    {speaker.get('circle_name')} > <a href={speaker.get('congregation_url')}>{speaker.get('congregation_name')}</a>
                </div>
                {speaker.get('phone') && <div className="kwfLocal__phone">{trl.trl('Tel:')} <a href={`tel:${speaker.get('phone')}`}>{speaker.get('phone')}</a></div>}
                {speaker.get('email') && <div className="kwfLocal__email"><a href={`mailto:${speaker.get('email')}`}>{speaker.get('email')}</a></div>}
                {speaker.get('note') && <div className="kwfLocal__note">{speaker.get('note')}</div>}
                <div className="kwfLocal__toggleTalks" onClick={(ev) => this.toggleTalks()}>{showTalks ? trl.trl('Vorträge ausblenden') : trl.trl('Vorträge anzeigen')}</div>
                <table className={`kwfLocal__talks ${showTalks ? 'kwfLocal__talks--show': ''}`}><tbody>
                    {speaker.get('talks').map((talk) => (
                        <tr key={talk.get('id')}><td>{talk.get('number')}</td><td>{talk.get('title')}</td></tr>
                    ))}
                </tbody></table>
            </div>
        );
    }
}

function mapStateToProps(state, ownProps) {
    const { speaker } = ownProps;
    return {
        speaker
    };
}

const mapDispatchToProps = (dispatch) => {
    return {
    };
};


const Connector = connect(mapStateToProps, mapDispatchToProps)(Speaker);

Connector.propTypes = {
    speaker: PropTypes.object.isRequired
};

export default Connector;
