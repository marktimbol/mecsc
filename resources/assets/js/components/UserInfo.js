import React from 'react';

var UserInfo = React.createClass({

	getDefaultProps() {
		return {
			showAddButton: true,
			action: 'add'
		}
	},

	render() {
		return (
			<li className="list-group-item User UserInfo">
				<div className="User__image">
					<img src="/dist/img/user1-128x128.jpg" 
						width="60" height="60" 
						alt={this.props.user.name} title={this.props.user.name} 
						className="img-circle" />
				</div>

				<div className="User__information">
					<h5 className="User__name">
						<a href={this.props.url}>
							{this.props.user.name}
						</a>
					</h5>
					<h6 className="User__designation">
						{this.props.user.designation} at {this.props.user.company}
					</h6>
				</div>

				<div className="User__action">
					{
						this.props.showAddButton ?					
							<button type="submit" 
								className="btn btn-link"
								onClick={() => this.props.onSave(this.props.user)}>
									<i className="fa fa-plus"></i>
							</button>
						: ''
					}

					{ this.props.action == 'remove' ? 
						<button type="submit" 
							className="btn btn-link"
							onClick={() => this.props.onDelete(this.props.user)}>
								<i className="fa fa-minus"></i>
						</button>
						: ''
					}
				</div>
			</li>   
		)
	}
});

export default UserInfo;