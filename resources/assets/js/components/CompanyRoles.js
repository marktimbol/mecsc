var React = require('react');
var ReactDOM = require('react-dom');
var csrf_token = $('meta[name="csrf_token"]').attr('content');

import Role from './Role';

var CompanyRoles = React.createClass({

	getInitialState() {
		return {
			companyRoles: window.company.roles,
		}
	},

	addRole(roleId) {
		var url = '/dashboard/companies/'+window.company.id+'/roles';

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
					companyRoles: response
				});
			}.bind(this),
			error: function(xhr, status, err) {
				console.log(err.toString());
			},
		});
	},

	removeRole(roleId) {
		var url = '/dashboard/companies/'+window.company.id+'/roles/'+roleId;

		$.ajax({
			url: url,
			type: 'DELETE',
			headers: {
				'X-CSRF-Token': csrf_token,
			},
			success: function(response) {
				this.setState({
					companyRoles: response
				});
			}.bind(this),
			error: function(xhr, status, err) {
				console.log(err.toString());
			},
		});
	},

	render() {		
		var roles = window.roles.map(function(role) {
			var isCheck = false;

			this.state.companyRoles.map(function(companyRole) {
				if( companyRole.id == role.id )
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

		var companyRoles = this.state.companyRoles.map(function(companyRole) {
			return (
                <span key={companyRole.id}>
                    <label className="label label-success">
                        {companyRole.title}
                    </label>&nbsp;
                </span>     
			);
		});

		return (
			<div>
				{ companyRoles }
				{ roles }
			</div>
		)
	}
});

ReactDOM.render(
	<CompanyRoles />,
	document.getElementById('CompanyRoles')
);