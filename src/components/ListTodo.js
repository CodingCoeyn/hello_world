import React, {Fragment, useEffect, useState} from "react";

//components
import EditTodoMethod from "./EditTodo";

const ListTodoMethod = () => {

    const [todos, setTodos] = useState([]);
    //get function
    const getAllTodos = async () =>{
        try {
            const response = await fetch("http://localhost:5000/todos");
            const jsonData = await response.json();

            // console.log(jsonData);

            setTodos(jsonData);
        } catch (err) {
            console.error(err.message);
            
        } 
    };
    //delete function
    const deleteTodo = async id =>{
        try {//dont concat with a +, you concat w/ a $, specifically variables
            const response = await fetch(`http://localhost:5000/todos/${id}`, {
                method: "DELETE"
            });
            // console.log(deleteTodo);
            setTodos(todos.filter(todo => todo.todo_id !== id));// shortens array w/o refresh

        } catch (err) {

            console.error(err.message); //do more research
        }
    };
  
    useEffect(() => {
        getAllTodos();
    }, []);
    return (
        <Fragment>
            <table className="table mt-5 text-center">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                <tbody>
                {/* 
                
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                    </tr>
                */}
                {todos.map(todo => ( //like foreach todo as todos
                    <tr key={todo.todo_id}>
                        <td>{todo.description}</td>
                        <td><EditTodoMethod todo={todo} /></td>
                        <td><button onClick={() => deleteTodo(todo.todo_id)}className="btn btn-cyan_dweet">Delete</button></td>
                    </tr>
                ))}
                   
                </tbody>
            </table>
        </Fragment>

    );
};



export default ListTodoMethod; 