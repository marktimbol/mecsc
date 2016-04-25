import React from 'react';

var SearchUser = React.createClass({
	render() {
		return (
			<form onSubmit={() => this.props.onSubmit}>
				<div className="form-group">
					<input 
						type="text" 
						placeholder={this.props.placeholder}
						className="form-control typeahead"
						value={this.props.value}
						onChange={this.props.onChange}/>
				</div>
				<div className="form-group">
					<button className="btn btn-default" onClick={this.props.onSubmit}>
						<i className="fa fa-search"></i> Search
					</button>
				</div>
			</form>
		)
	}
});

export default SearchUser;