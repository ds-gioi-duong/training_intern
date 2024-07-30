import React, { useState } from 'react';
import Task from './Task'; 

export default function TaskList({ initialTasks}) {
    const [tasks, setTasks] = useState(initialTasks);
    const handleDelete = (taskId) => {
        setTasks(tasks.filter(task => task.id !== taskId));
        {console.log(tasks)}
    };
    
    return (
        <div>
            {tasks.map(task => (
                <Task key={task.id} task={task} onDelete={handleDelete} />
            ))}
        </div>
    );
}
