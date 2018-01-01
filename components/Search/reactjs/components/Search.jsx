import React, { Component } from 'react';
import { connect } from 'react-redux';
import trl from 'kwf/trl';
import * as actions from "../store/search/actions";

class Search extends Component {
    constructor(props) {
        super(props);
        this.state = {
            talk: '',
            talkLanguage: 'de', // select-feld
            firstname: '',
            lastname: '',
            phone: '',
            circleOrCircleGroup: '', // select-feld
            congregation: '', // select-feld
            maxDistance: 50,
            noBeard: false
        };
    }

    render() {
        const { talkLanguages, circleGroups } = this.props;

        const circleGroupOrCircleOptions = [];
        circleGroupOrCircleOptions.push(
            <option key={`circleGroup_`} value="">
                {trl.trl('Keine Auswahl')}
            </option>
        );
        const congregationOptions = [];
        if (this.state.circleOrCircleGroup) {
            congregationOptions.push(
                <option key={`congregation_`} value="">
                    {trl.trl('Keine Auswahl')}
                </option>
            );
        } else {
            congregationOptions.push(
                <option key={`congregation_`} value="">
                    {trl.trl('Bitte vorher Kreis wählen')}
                </option>
            );
        }

        Object.keys(circleGroups).map((circleGroupId) => {
            circleGroupOrCircleOptions.push(
                <option key={`circleGroup_${circleGroupId}`} value={circleGroupId}>
                    {circleGroups[circleGroupId]['name']}
                </option>
            );

            Object.keys(circleGroups[circleGroupId]['circles']).map((circleId) => {
                circleGroupOrCircleOptions.push(
                    <option key={`circle_${circleId}`} value={circleId}>
                        {` - ${circleGroups[circleGroupId]['circles'][circleId]['name']}`}
                    </option>
                );
                if (this.state.circleOrCircleGroup == circleGroupId
                    || this.state.circleOrCircleGroup == circleId
                ) {
                    Object.keys(circleGroups[circleGroupId]['circles'][circleId]['congregations']).map((congregationId => {
                        congregationOptions.push(
                            <option key={`congregation_${congregationId}`} value={congregationId}>
                                {circleGroups[circleGroupId]['circles'][circleId]['congregations'][congregationId]}
                            </option>
                        );
                    }));
                }
            });
        });

        return (
            <div className="kwfLocal kwfUp-webStandard kwfUp-webForm">
                <div className="kwfLocal__field has-float-label">
                    <input type="text" id="kwfLocalTalk" name="talk" value={this.state.talk} placeholder={trl.trl("z.B: '123' oder 'Wie gut'")} onChange={(ev) => this._updateState(ev)}/>
                    <label htmlFor="kwfLocalTalk">{trl.trl('Vortragsnummer/-titel')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <select id="kwfLocalTalkLanguage" name="talkLanguage" value={this.state.talkLanguage} onChange={(ev) => this._updateState(ev)}>
                        { Object.keys(talkLanguages).map((languageId) => (
                            <option key={`language_${languageId}`} value={languageId}>{talkLanguages[languageId]}</option>
                        ))}
                    </select>
                    <label htmlFor="kwfLocalTalkLanguage">{trl.trl('Vortragssprache')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <input type="text" id="kwfLocalFirstname" name="firstname" value={this.state.firstname} placeholder={trl.trl('Vorname')} onChange={(ev) => this._updateState(ev)}/>
                    <label htmlFor="kwfLocalFirstname">{trl.trl('Vorname')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <input type="text" id="kwfLocalLastname" name="lastname" value={this.state.lastname} placeholder={trl.trl('Nachname')} onChange={(ev) => this._updateState(ev)}/>
                    <label htmlFor="kwfLocalLastname">{trl.trl('Nachname')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <input type="text" id="kwfLocalPhone" name="phone" value={this.state.phone} placeholder={trl.trl('Telefon')} onChange={(ev) => this._updateState(ev)}/>
                    <label htmlFor="kwfLocalPhone">{trl.trl('Telefonnummer')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <select id ="kwfLocalCircleOrCircleGroup" name="circleOrCircleGroup" value={this.state.circleOrCircleGroup} onChange={(ev) => this._updateState(ev)}>
                        { circleGroupOrCircleOptions.map((circleGroupOrCircleElement) => (circleGroupOrCircleElement))}
                    </select>
                    <label htmlFor="kwfLocalCircleOrCircleGroup">{trl.trl('Kreis')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <select id ="kwfLocalCongregation" name="congregation" value={this.state.congregation} onChange={(ev) => this._updateState(ev)} disabled={!this.state.circleOrCircleGroup}>
                        { congregationOptions.map((congregationElement) => (congregationElement))}
                    </select>
                    <label htmlFor="kwfLocalCongregation">{trl.trl('Versammlung')}</label>
                </div>
                <div className="kwfLocal__field has-float-label">
                    <input type="text" id ="kwfLocalMaxDistance" name="maxDistance" value={this.state.maxDistance} placeholder={trl.trl('Luftlinie (km)')} onChange={(ev) => this._updateState(ev)}/>
                    <label htmlFor="kwfLocalMaxDistance">{trl.trl('Luftlinie (km)')}</label>
                </div>
                <div className="kwfLocal__field kwfLocal__checkbox has-float-label">
                    <input type="checkbox" id ="kwfLocalNoBeard" name="noBeard" defaultChecked={this.state.noBeard}  onChange={(ev) => this._updateState(ev)}/>
                    <label htmlFor="kwfLocalNoBeard">{trl.trl('Kein Voll-/Modebart')}</label>
                </div>

                <div className="kwfLocal__search" onClick={ev => this._onClickHandler(ev)}>Suchen</div>
            </div>
        );
    }

    _updateState(ev) {
        const newState = {
            [ev.target.name]: ev.target.type === 'checkbox' ? ev.target.checked : ev.target.value
        };
        if (ev.target.name == 'circleOrCircleGroup') {
            newState.congregation = '';
        }
        this.setState(newState);
    }

    _onClickHandler() {
        this.props.onSearch(this.state);
    }
}

// values to initialise Search
function mapStateToProps(state, ownProps) {
    const { talkLanguages, circleGroups } = state;

    return {
        talkLanguages,
        circleGroups
    };
}

const mapDispatchToProps = (dispatch) => {
    return {
        onSearch: (params) => {
            dispatch(actions.fetchResults(params));
            dispatch(actions.saveLastRequestParams(params));
        }
    };
};

const Connector = connect(mapStateToProps, mapDispatchToProps)(Search);

// propTypes to initialise SearchContainer
Connector.propTypes = {
};

export default Connector;
