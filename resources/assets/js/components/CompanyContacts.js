var React = require('react');
var ReactDOM = require('react-dom');
var update = require('react-addons-update');
var _ = require('lodash');
var algoliasearch = require('algoliasearch');

var csrf_token = $('meta[name="csrf_token"]').attr('content');

var index;

var CompanyContacts = React.createClass({

	getInitialState()
	{
		return {
			searchKey: '',
			companyContacts: window.company.contacts,
			availableContacts: [],
		}
	},

	componentDidMount()
	{
		var client = algoliasearch("CU6OGKCO5Z", '9230fbbc6127c4250e0362facfe0f019');
		index = client.initIndex('mecsc_users');

		this.enableTypeahead();
		this.refreshAvailableContacts();
	},

	enableTypeahead()
	{
		$('.typeahead')
			.typeahead({
				minLength: 1,
				highlight: true,
				hint: false,
			}, {
				name: 'users',
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
											hit.email +
										'</p>' +
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
			data: {
				data,
			},
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

	searchContact(e)
	{
		e.preventDefault();
		$('.typeahead').typeahead('close');

		index.search(this.state.searchKey, null, function(error, result) {
		  	this.setState({ availableContacts: result.hits });
		}.bind(this), { hitsPerPage: 10, page: 0 });
	},

	refreshAvailableContacts()
	{
		this.setState({ searchKey: '' });

		index.search('', null, function(error, result) {
		  	this.setState({ availableContacts: result.hits });
		}.bind(this), { hitsPerPage: 10, page: 0 });
	},

	addContact(selectedContact)
	{
		this.setState({
			companyContacts: this.state.companyContacts.concat(selectedContact)
		});

		this.refreshAvailableContacts();

		var url = '/dashboard/companies/' + window.company.id + '/contacts';
		var data = {
			'contact_id' : selectedContact.id
		}

		this.makeRequest('POST', url, data);
	},

	removeContact(selectedContact)
	{
		var contactIndex = _.findIndex(this.state.companyContacts, function(companyContact) {
		    return companyContact.id == selectedContact.id;
		});

		this.setState({
			companyContacts: update(this.state.companyContacts, {$splice: [[contactIndex, 1]]}),
		});

		this.refreshAvailableContacts();

		var url = '/dashboard/companies/' + window.company.id + '/contacts/' + selectedContact.id;
		this.makeRequest('DELETE', url, []);
	},

	render()
	{
		var companyContacts = this.state.companyContacts.map(function(companyContact) {
			return (
				<li className="list-group-item User" key={companyContact.id}>
					<div className="User__image">
						<img src="/dist/img/user1-128x128.jpg" 
							width="60" height="60" 
							alt={companyContact.name} title={companyContact.name} 
							className="img-circle" />
					</div>

					<div className="User__information">
						<h5 className="User__name">
							<a href="#">
								{companyContact.name}
							</a>
						</h5>
						<h6 className="User__designation">
							{companyContact.designation} at {companyContact.company}
						</h6>
					</div>

					<div className="User__action">
						<button type="submit" 
							className="btn btn-link"
							onClick={() => this.removeContact(companyContact)}>
								<i className="fa fa-minus"></i>
						</button>
					</div>
				</li>   
			);
		}.bind(this));		

		var availableContacts = this.state.availableContacts.map(function(availableContact) {
			var isPartOfThisCompany = false;
			this.state.companyContacts.map(function(companyContact) {
				if( companyContact.id === availableContact.id )
				{
					isPartOfThisCompany = true;
				}
			});

			var userUrl = '/dashboard/users/' + availableContact.id;
			return (
				<li className="list-group-item User" key={availableContact.id}>
					<div className="User__image">
						<img src="/dist/img/user1-128x128.jpg" 
							width="60" height="60" 
							alt={availableContact.name} title={availableContact.name} 
							className="img-circle" />
					</div>

					<div className="User__information">
						<h5 className="User__name">
							<a href={userUrl}>
								{availableContact.name}
							</a>
						</h5>
						<h6 className="User__designation">
							{availableContact.designation} at {availableContact.company}
						</h6>
					</div>

					{ ! isPartOfThisCompany ?
						<div className="User__action">
							<button type="submit" 
								className="btn btn-link"
								onClick={() => this.addContact(availableContact)}>
									<i className="fa fa-plus"></i>
							</button>
						</div>
						: ''
					}
				</li>   
			);
		}.bind(this));

		return (
			<div className="Users">
				<h3>Contacts ({companyContacts.length})</h3>
				<ul className="list-group">
         			{companyContacts}
				</ul>

				<h3>Available Contacts</h3>
				<form onSubmit={() => this.searchContact}>
					<div className="form-group">
						<input 
							type="text" 
							placeholder="Find Contact"
							className="form-control typeahead"
							value={this.state.searchKey}
							onChange={this.handleChangeSearch}/>
					</div>
					<div className="form-group">
						<button className="btn btn-default" onClick={this.searchContact}>
							<i className="fa fa-search"></i> Search
						</button>
					</div>
				</form>

				<ul className="list-group">
         			{availableContacts}
				</ul>
			</div>
		)
	}
});

ReactDOM.render(
	<CompanyContacts />,
	document.getElementById('CompanyContacts')
);