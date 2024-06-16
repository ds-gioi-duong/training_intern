// resources/js/components/TimesheetDetail.jsx
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import React, { useState } from 'react';
import { useForm, Head, usePage} from '@inertiajs/react';


export default function TimesheetDetail  ({ timesheet }) {
    const { auth } = usePage().props;
    const [newTaskName, setNewTaskName] = useState('');
    const [newTaskDescription, setNewTaskDescription] = useState('');

    const handleAddTask = () => {
        const newTask = {
            name: newTaskName,
            description: newTaskDescription,
        };

        onAddTask(newTask);
        setNewTaskName('');
        setNewTaskDescription('');
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Timesheet</h2>}
        >
            <Head title="Timesheet" />

            <div className="dark:text-white">
                <h1>Chi tiết Timesheet</h1>
                <p>ID: {timesheet.id}</p>
                <p>Tên: {timesheet.name}</p>

                <h2>Các Task</h2>
                <ul>
                    {timesheet.tasks && timesheet.tasks.map(task => (
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
        </AuthenticatedLayout>
    );
};



