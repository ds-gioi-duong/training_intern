import React, { useState } from 'react';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, usePage } from '@inertiajs/react';

export default function Task({ task , onDelete }) {
    const { auth } = usePage().props;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const [editing, setEditing] = useState(false);

    const { data, setData, patch, clearErrors, reset, errors } = useForm({
        content: task.content,
    });

    const handleDelete = async (e) => {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this task?')) {
            const response = await fetch(route('tasks.destroy', [task.timesheet_id, task.id]), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (response.ok) {
                alert('Task deleted successfully');
                onDelete(task.id);
            } else {
                alert('Failed to delete task');
            }
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        await patch(route('tasks.update', task.id), {
            onSuccess: () => {
                setEditing(false);
                reset();
                clearErrors();
            },
            onError: () => {
                // Optionally handle errors
            }
        });
    };

    return (
        <div className="p-6 flex space-x-2">
            <div className="flex-1">
                <div className="flex justify-between items-center">
                    <div>
                        <small className="ml-2 text-sm text-gray-600">{`${task.start_time}-${task.end_time}`}</small>
                        {task.created_at !== task.updated_at && <small className="text-sm text-gray-600"> &middot; edited</small>}
                    </div>
                    <button 
                        className="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                        onClick={() => setEditing(true)}
                    >
                        Edit
                    </button>

                    <form onSubmit={handleDelete}>
                        <button type="submit" className="ml-2 px-4 py-2 bg-red-600 text-white rounded">
                            Delete
                        </button>
                    </form>
                </div>

                {editing ? (
                    <form onSubmit={handleSubmit}>
                        <textarea 
                            value={data.content} 
                            onChange={e => setData('content', e.target.value)} 
                            className="w-full mt-2 p-2 border border-gray-300 rounded"
                        />
                        <InputError message={errors.content} className="mt-2" />
                        <div className="space-x-2 mt-4">
                            <PrimaryButton type="submit">Save</PrimaryButton>
                            <button 
                                type="button" 
                                className="mt-4 px-4 py-2 border border-gray-300 rounded"
                                onClick={() => { 
                                    setEditing(false); 
                                    reset(); 
                                    clearErrors(); 
                                }}
                            >
                                Cancel
                            </button>
                        </div>
                    </form>
                ) : (
                    <p className="mt-4 text-lg text-gray-900">{task.content}</p>
                )}
            </div>
        </div>
    );
}
