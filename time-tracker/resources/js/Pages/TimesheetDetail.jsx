// resources/js/components/TimesheetDetail.jsx

import React, { useState } from 'react';

const TimesheetDetail = ({ timesheet, onAddTask }) => {
    const [newTaskName, setNewTaskName] = useState('');
    const [newTaskDescription, setNewTaskDescription] = useState('');

    const handleAddTask = () => {
        // Validate input (optional)

        // Create new task object
        const newTask = {
            name: newTaskName,
            description: newTaskDescription,
        };

        // Call parent function to add task
        onAddTask(newTask);

        // Clear form fields
        setNewTaskName('');
        setNewTaskDescription('');
    };

    return (
        <div>
            <h1>Chi tiết Timesheet</h1>
            <p>ID: {timesheet.id}</p>
            <p>Tên: {timesheet.name}</p>

            <h2>Các Task</h2>
            <ul>
                {timesheet.tasks.map(task => (
                    <li key={task.id}>
                        {task.name} - {task.description}
                    </li>
                ))}
            </ul>

            <h2>Note</h2>
            <p>{timesheet.note}</p>

            <h2>Thêm Task Mới</h2>
            <div>
                <label htmlFor="newTaskName">Tên Task:</label>
                <input
                    type="text"
                    id="newTaskName"
                    value={newTaskName}
                    onChange={e => setNewTaskName(e.target.value)}
                />
            </div>
            <div>
                <label htmlFor="newTaskDescription">Mô tả Task:</label>
                <textarea
                    id="newTaskDescription"
                    value={newTaskDescription}
                    onChange={e => setNewTaskDescription(e.target.value)}
                />
            </div>
            <button onClick={handleAddTask}>Thêm Task</button>
        </div>
    );
};

export default TimesheetDetail;
