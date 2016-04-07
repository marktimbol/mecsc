var React = require('react');

var Role = React.createClass({

	handleChange(e) {
		var roleId = e.target.value;
		if( this.props.isChecked )
		{
			return this.props.removeRole(roleId);
		}

		return this.props.addRole(roleId);
	},

	render() {
		return (
			<div className="checkbox">
				<label>
					<input type="checkbox" 
						value={this.props.role.id} 
						defaultChecked={this.props.isChecked} 
						onChange={this.handleChange } /> 
						{ this.props.role.title }
				</label>
			</div>
		)
	}
});

export default Role;