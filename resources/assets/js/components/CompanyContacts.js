var React = require('react');
var ReactDOM = require('react-dom');

var CompanyContacts = React.createClass({
	render() {
		return (
			<div>
				<h3>Contacts</h3>
			</div>
		)
	}
});

ReactDOM.render(
	<CompanyContacts />,
	document.getElementById('CompanyContacts')
);