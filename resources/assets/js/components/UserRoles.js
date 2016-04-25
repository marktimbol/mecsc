var React = require('react');
var ReactDOM = require('react-dom');
var csrf_token = $('meta[name="csrf_token"]').attr('content');

import Role from './Role';

var UserRoles = React.createClass({

	getInitialState() {
		return {
			userRoles: window.user.roles,
		}
	},

	addRole(roleId) {
		var url = '/dashboard/users/'+window.user.id+'/roles';

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				'role_id': roleId,
			},
			headers: {
				'X-CSRF-Token': csrf_token,
			},
			success: function(response) {
				this.setState({
					userRoles: response
				});
			}.bind(this),
			error: function(xhr, status, err) {
				console.log(err);
			}.bind(this),
		});
	},

	removeRole(roleId) {
		var url = '/dashboard/users/'+window.user.id+'/roles/'+roleId;

		$.ajax({
			url: url,
			type: 'DELETE',
			headers: {
				'X-CSRF-Token': csrf_token,
			},
			success: function(response) {
				this.setState({
					userRoles: response
				});
			}.bind(this),
			error: function(xhr, status, err) {
				console.log(err.toString());
			}.bind(this),
		});
	},

	render() {		
		var roles = window.roles.map(function(role) {
			var isCheck = false;

			this.state.userRoles.map(function(userRole) {
				if( userRole.id == role.id )
				{
					isCheck = true;
				}
			});

			return (
				<Role key={role.id} 
					role={role} 
					isChecked={isCheck} 
					addRole={this.addRole} 
					removeRole={this.removeRole} />
			)
		}.bind(this));

		var userRoles = this.state.userRoles.map(function(userRole) {
			return (
                <span key={userRole.id}>
                    <label className="label label-success">
                        {userRole.title}
                    </label>&nbsp;
                </span>     
			);
		});

		return (
			<div>
				{ userRoles }
				{ roles }
			</div>
		)
	}
});

ReactDOM.render(
	<UserRoles />,
	document.getElementById('UserRoles')
);