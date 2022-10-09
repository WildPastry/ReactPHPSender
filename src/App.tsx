import './App.css';
import React, { Component } from 'react';
import axios from 'axios';
const API_PATH = 'http://localhost/practice-work/react-php/api/contact/index.php';

class App extends Component {
  constructor(props: {} | Readonly<{}>) {
    super(props);
    this.state = {
      mailSent: false,
      error: null,
      fname: '',
      lname: '',
      email: '',
      message: ''
    };
    this.handleFormSubmit = this.handleFormSubmit.bind(this);
  }

  handleFormSubmit = (e: React.MouseEvent<HTMLInputElement, MouseEvent>) => {
    e.preventDefault();
    axios({
      method: 'POST',
      url: `${API_PATH}`,
      headers: { 'content-type': 'application/json' },
      data: this.state
    })
      .then((result) => {
        this.setState({
          mailSent: result.data.sent
        });
      })
      .catch((error) => this.setState({ error: error.message }));
  };

  render() {
    return (
      <div className='App'>
        <p>Contact Me</p>
        <div>
          <form action='/action_page.php'>
            <label>First Name</label>
            <input
              type='text'
              id='fname'
              name='firstname'
              placeholder='Your name..'
              value={this.state.fname}
              onChange={(e) => this.setState({ fname: e.target.value })}
            />
            <label>Last Name</label>
            <input
              type='text'
              id='lname'
              name='lastname'
              placeholder='Your last name..'
              value={this.state.lname}
              onChange={(e) => this.setState({ lname: e.target.value })}
            />
            <label>Email</label>
            <input
              type='email'
              id='email'
              name='email'
              placeholder='Your email'
              value={this.state.email}
              onChange={(e) => this.setState({ email: e.target.value })}
            />
            <label>Subject</label>
            <textarea
              id='subject'
              name='subject'
              placeholder='Write something..'
              value={this.state.message}
              onChange={(e) => this.setState({ message: e.target.value })}
            />
            <input type='submit' onClick={(e) => this.handleFormSubmit(e)} value='Submit' />
          </form>
          <div>{this.state.mailSent && <div>Thank you for contcting us.</div>}</div>
        </div>
      </div>
    );
  }
}

export default App;
