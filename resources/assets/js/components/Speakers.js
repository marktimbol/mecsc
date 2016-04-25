var React = require('react');
var ReactDOM = require('react-dom');
var update = require('react-addons-update');
var _ = require('lodash');
var algoliasearch = require('algoliasearch');

var csrf_token = $('meta[name="csrf_token"]').attr('content');

var index;

import UserInfo from './UserInfo';
import SearchUser from './SearchUser';

var Speakers = React.createClass({
	getInitialState()
	{
		return {
			searchKey: '',
			agendaSpeakers: window.agenda.speakers,
			availableSpeakers: [],
		}
	},

	componentDidMount()
	{
		var client = algoliasearch("CU6OGKCO5Z", '9230fbbc6127c4250e0362facfe0f019');
		index = client.initIndex('mecsc_speakers');

		this.enableTypeahead();
		this.refreshAvailableSpeakers();
	},

	enableTypeahead()
	{
		$('.typeahead')
			.typeahead({
				minLength: 1,
				highlight: true,
				hint: false,
			}, {
				name: 'speakers',
				source: index.ttAdapter(),
				displayKey: 'name',
				templates: {
					notFound: function() {
						return (
							'<div class="Suggestion--no-result"><p>No result found.</p></div>'
						)
					},
					suggestion: function(hit) {
						var imagePath = '/dist/img/user1-128x128.jpg';
						return (
							'<div class="Suggestion">' +
								'<div class="Suggestion__figure">' +
									'<img src="'+imagePath+'" class="img-responsive" alt="" title="" />' +
								'</div>' +

								'<div class="Suggestion__content">' +
									'<h3 class="Suggestion__heading">' + hit._highlightResult.name.value + '</h3>' +
									'<address>' +
										'<p>' +
											hit.designation + ' at ' + hit.company +
										'</p>' +										
									'</address>' +
								'</div>' +
							'</div>' 
						)
					}
				
				}
			})
			.on('typeahead:select', function(e, suggestion) {
				this.setState({
					searchKey: suggestion.name
				});
			}.bind(this));	
	},

	makeRequest(type, url, data)
	{
		$.ajax({
			url: url,
			type: type,
			data: data,
			headers: {
				'X-CSRF-Token': csrf_token,
			},
			success: function(response) {},
			error: function(xhr, status, err) {
				console.log(err.toString());
			}
		});
	},

	handleChangeSearch(e)
	{
		this.setState({ searchKey: e.target.value });
	},

	searchSpeaker(e)
	{
		e.preventDefault();
		$('.typeahead').typeahead('close');

		index.search(this.state.searchKey, null, function(error, result) {
		  	this.setState({ availableSpeakers: result.hits });
		}.bind(this), { hitsPerPage: 10, page: 0 });
	},

	refreshAvailableSpeakers()
	{
		this.setState({ searchKey: '' });

		index.search('', null, function(error, result) {
		  	this.setState({ availableSpeakers: result.hits });
		}.bind(this), { hitsPerPage: 10, page: 0 });
	},

	addSpeaker(selectedSpeaker)
	{
		this.setState({
			agendaSpeakers: this.state.agendaSpeakers.concat(selectedSpeaker),
		});

		this.refreshAvailableSpeakers();

		var url = '/dashboard/agendas/' + window.agenda.id + '/speakers';
		this.makeRequest('POST', url, { 'speaker_id': selectedSpeaker.id});
	},

	removeSpeaker(selectedSpeaker)
	{
		var speakerIndex = _.findIndex(this.state.agendaSpeakers, function(agendaSpeaker) {
		    return agendaSpeaker.id == selectedSpeaker.id;
		});

		this.setState({
			agendaSpeakers: update(this.state.agendaSpeakers, {$splice: [[speakerIndex, 1]]}),
		});

		this.refreshAvailableSpeakers();

		var url = '/dashboard/agendas/' + window.agenda.id + '/speakers/' + selectedSpeaker.id;
		this.makeRequest('DELETE', url, []);
	},

	render()
	{
		var agendaSpeakers = this.state.agendaSpeakers.map(function(speaker) {
			var url = '/dashboard/speakers/'+speaker.id;
			return (
				<UserInfo 
					key={speaker.id} 
					user={speaker} 
					url={url}
					action={'remove'}
					showAddButton={false}
					onDelete={this.removeSpeaker} />
			);
		}.bind(this));		

		var availableSpeakers = this.state.availableSpeakers.map(function(speaker) {
			var isSpeakingOnThisAgenda = false;
			this.state.agendaSpeakers.map(function(agendaSpeakers) {
				if( agendaSpeakers.id === speaker.id )
				{
					isSpeakingOnThisAgenda = true;
				}
			});

			var url = '/dashboard/users/' + speaker.id;
			return (
				<UserInfo 
					key={speaker.id} 
					user={speaker} 
					url={url}
					showAddButton={ ! isSpeakingOnThisAgenda }
					onSave={this.addSpeaker} />
			);
		}.bind(this));

		return (
			<div className="Users">
				<h3>Speakers ({agendaSpeakers.length})</h3>
				<ul className="list-group">
         			{agendaSpeakers}
				</ul>

				<h3>Available Speakers</h3>
				<SearchUser 
					onSubmit={this.searchSpeaker}
					value={this.state.searchKey}
					placeholder={'Search Speakers'}
					onChange={this.handleChangeSearch} />

				<ul className="list-group">
         			{availableSpeakers}
				</ul>
			</div>
		)
	},
});

ReactDOM.render(
	<Speakers />,
	document.getElementById('Speakers')
);