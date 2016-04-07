var React = require('react');
var ReactDOM = require('react-dom');
var update = require('react-addons-update');
var _ = require('lodash');

var csrf_token = $('meta[name="csrf_token"]').attr('content');

var Speakers = React.createClass({
	getInitialState() {
		return {
			agendaSpeakers: window.agenda.speakers,
			availableSpeakers: window.speakers,
		}
	},

	addSpeaker(selectedSpeaker) {
		var index = _.findIndex(this.state.availableSpeakers, function(availableSpeaker) {
		    return availableSpeaker.id == selectedSpeaker.id;
		});

		this.setState({
			agendaSpeakers: this.state.agendaSpeakers.concat(selectedSpeaker),
			availableSpeakers: update(this.state.availableSpeakers, {$splice: [[index, 1]]})
		});

		var url = '/dashboard/agendas/' + window.agenda.id + '/speaker/' + selectedSpeaker.id;

		$.ajax({
			url: url,
			type: 'POST',
			headers: {
				'X-CSRF-Token': csrf_token,
			},
			success: function(response) {
			
			},
			error: function(xhr, status, err) {
				console.log(err.toString());
			}
		});
	},

	removeSpeaker(selectedSpeaker) {
		var index = _.findIndex(this.state.agendaSpeakers, function(agendaSpeaker) {
		    return agendaSpeaker.id == selectedSpeaker.id;
		});

		this.setState({
			agendaSpeakers: update(this.state.agendaSpeakers, {$splice: [[index, 1]]}),
			availableSpeakers: this.state.availableSpeakers.concat(selectedSpeaker),
		});

		var url = '/dashboard/agendas/' + window.agenda.id + '/speaker/' + selectedSpeaker.id;

		$.ajax({
			url: url,
			type: 'DELETE',
			headers: {
				'X-CSRF-Token': csrf_token,
			},
			success: function(response) {

			},
			error: function(xhr, status, err) {
				console.log(err.toString());
			}
		});
	},

	render() {
		var agendaSpeakers = this.state.agendaSpeakers.map(function(speaker) {
			return (
				<li className="list-group-item Speaker" key={speaker.id}>
					<div className="Speaker__image">
						<img src="/dist/img/user1-128x128.jpg" 
							width="60" height="60" 
							alt={speaker.name} title={speaker.name} 
							className="img-circle" />
					</div>

					<div className="Speaker__information">
						<h5 className="Speaker__name">
							<a href="#">
								{speaker.name}
							</a>
						</h5>
						<h6 className="Speaker__designation">
							{speaker.designation} at {speaker.company}
						</h6>
					</div>

					<div className="Speaker__action">
						<button type="submit" 
							className="btn btn-link"
							value={speaker.id}
							onClick={() => this.removeSpeaker(speaker)}>
								<i className="fa fa-minus"></i>
						</button>
					</div>
				</li>   
			);
		}.bind(this));		

		var availableSpeakers = this.state.availableSpeakers.map(function(speaker) {
			var speakerUrl = '/dashboard/users/' + speaker.id;
			return (
				<li className="list-group-item Speaker" key={speaker.id}>
					<div className="Speaker__image">
						<img src="/dist/img/user1-128x128.jpg" 
							width="60" height="60" 
							alt={speaker.name} title={speaker.name} 
							className="img-circle" />
					</div>

					<div className="Speaker__information">
						<h5 className="Speaker__name">
							<a href={speakerUrl}>
								{speaker.name}
							</a>
						</h5>
						<h6 className="Speaker__designation">
							{speaker.designation} at {speaker.company}
						</h6>
					</div>

					<div className="Speaker__action">
						<a href="#" 
							className="btn btn-link"
							onClick={(e) => this.addSpeaker(speaker)}>
								<i className="fa fa-plus"></i>
						</a>
					</div>
				</li>   
			);
		}.bind(this));

		return (
			<div>
				<h3>Speakers</h3>
				<ul className="list-group">
         			{agendaSpeakers}
				</ul>

				<h3>Available Speakers</h3>
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