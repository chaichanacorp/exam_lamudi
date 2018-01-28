import React, { Component } from 'react';
import './App.css';

// global declaration of localhost for php
let localHost = 'http://localhost/exam_lamudi';

class App extends Component {

  constructor(props){
    super(props)
    this.state = {
      items: []
    }
  }

  // for getting data
  componentDidMount = () => {
    fetch(localHost + "/userinput/read.php")
      .then(response => response.json())
      .then((responseJson) => {
          if (responseJson.id !== null){
            this.setState({
              items: responseJson.todo_list
            });
          }else{
            this.setState({
              items: []
            });
            this.setState({
              alert: "alert-info",
              message: "Note: No to-do items yet, please add."
            });                
          }
      }).catch((error) => {
          console.log(error);                
      });
  }  

  // for insert
  InsertTodo = (e) => {
    e.preventDefault();
    
    let TodoItem = this.todoInput.value;
    if (TodoItem == ''){
      this.setState({
        alert: "alert-danger",
        message: "Note: Please enter your to-do item!"
      });
    } else {
      fetch(localHost + "/userinput/create.php", {
        method: "POST",
        headers: {
          "Accept" : "application/json",
          "Content-Type" : "application/json"
        },
        body: JSON.stringify({
          "todo_item" : TodoItem,
          "is_done" : 0
        })
      }).then((response) => response.json())
        .then((responseJson) => {
            const newItem = ({ 'id' : responseJson.id, 'todo_item': TodoItem, "is_done" : 0 });
            this.setState ({
              items: [...this.state.items, newItem]
            });
            this.setState({
              alert: "alert-success",
              message: "Note: Succesfully added your to-do item!"
            });          
            this.formTodo.reset();
        }).catch((error) => {
            console.log(error);
        });
    }
  }

  // for delete
  DeleteTodo = (item, index) => {
    fetch(localHost + "/userinput/delete.php?id=" + item, {
      method: "DELETE"
    }).then((response) => response.json())
      .then((responseJson) => {
        const newAray = this.state.items.slice();
        newAray.splice(index, 1);
        this.setState({ items: newAray });        
        if(newAray.length === 0){
          this.setState({
            alert: "alert-danger",
            message: "Note: No more to-do list!"
          });
        } else {
          this.setState({
            alert: "alert-info",
            message: "Note: Successfully removed to-do item."
          });        
        }
      }).catch((error) => {
        console.log(error);
      });    
  }

  // for complete to do
  DoneToDo = (item, index) => {
    let todoUpdate = null;
    let todo = {...this.state.items}
   
    if (todo[index].is_done == 0) {
      todoUpdate = 1 ;
      todo[index].is_done = todoUpdate
    } else {      
      todoUpdate = 0 ;
      todo[index].is_done = todoUpdate;
    }
    this.forceUpdate();

    fetch(localHost + "/userinput/update.php", {
      method: "PUT",
      headers: {
        "Accept" : "application/json",
        "Content-Type" : "application/json"
      },
      body: JSON.stringify({
        "id" : item,
        "is_done" : todoUpdate
      })
    }).then((response) => response.json())
      .then((responseJson) => {
          console.log(responseJson);
      }).catch((error) => {
          console.log(error);
      });    
  }

  render() {
    const { message, alert } = this.state
    const listDataDOM = this.state.items.map((item,index) => {
        return (
          <tr key={item.id} className={item.is_done == 0 ? null : 'warning'}>
            <td>
                <input type="checkbox" ref="newtodo" onChange={this.DoneToDo.bind(this, item.id, index)} className="option-input checkbox" defaultChecked={ item.is_done == 0 ? false : true }/>
            </td>
            <td>
              <span className={item.is_done == 0 ? null : 'line'}>
                {item.todo_item}
              </span>
            </td>
            <td>
              <button className="btn btn-danger" onClick={ this.DeleteTodo.bind(this, item.id, index)}>Remove</button>
            </td>
          </tr>)
        });

    return(
      <div className="App">
        <header className="App-header">
          <h1>To-do List</h1>

          <div className="Form-center">
            <form className="form-horizontal" ref={input => this.formTodo = input} onSubmit={(e) => {this.InsertTodo(e) }} >
              <div className="form-group">
                <textarea type="textarea" ref={(input) => { this.todoInput = input }} className="form-control" placeholder="Enter to-do..."></textarea>
              </div>
              <button type="submit" className="btn btn-primary">Add</button>
            </form>
          </div>
        </header>
        {
          (message !== '' || listDataDOM.length === 0) && <p className={ alert }>{ message }</p>
        }
        {
          listDataDOM.length > 0 &&
          <div className="table-responsive">
            <table className="table table-hover table-bordered">
                <thead>
                  <tr>
                      <th></th>
                      <th>To-do</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  {listDataDOM}
                </tbody>
            </table>
          </div>          
        }

      </div>
    );
  }
}

export default App;
