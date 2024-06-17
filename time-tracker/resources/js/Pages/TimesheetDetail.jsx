// resources/js/components/TimesheetDetail.jsx
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import React, { useState } from 'react';
import { useForm, Head, usePage } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';

export default function TimesheetDetail({ timesheet }) {
    const { auth } = usePage().props;
    const { data, setData, post, processing, reset, errors } = useForm({
        timesheet_id: timesheet.id,
        content: '',
        time_start: '',
        time_end: '',
        time_spent: '',
    });

    const calculateTimeSpent = (start, end) => {
        const startTime = new Date(`1970-01-01T${start}:00`);
        const endTime = new Date(`1970-01-01T${end}:00`);
        const diff = (endTime - startTime) / 1000 / 60; // Difference in minutes
        return diff > 0 ? diff : 0;
    };


    const submit = (e) => {
        e.preventDefault();
        const timeSpent = calculateTimeSpent(data.time_start, data.time_end);
        setData('time_spent', timeSpent);
        post(route('tasks.store', timesheet, { absolute: false }), { onSuccess: () => reset() });
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
                <p>Ngày: {timesheet.date}</p>

                <h2>Các công việc đã làm trong ngày</h2>
                {timesheet.tasks && timesheet.tasks.map((task, index) => (
                    <div key={index} className="border-b border-gray-200 py-4">
                        <p><strong>Thời gian: {task.time_used}</strong></p>
                        <p><strong>Task ID:</strong> {task.id ? task.id : 'N/A'}</p>
                        <p><strong>Nội dung task:</strong> {task.description}</p>
                    </div>
                ))}

                <h2>Các khó khăn gặp phải</h2>
                <p>{timesheet.difficulties}</p>

                <h2>Các dự định sẽ làm trong ngày tiếp theo</h2>
                <p>{timesheet.next_day_plans}</p>

                <h2>Note</h2>
                <p>{timesheet.note}</p>

                <h2>Thêm Task Mới</h2>
                <form onSubmit={submit}>
                    <div>
                        <label htmlFor="newTaskName">Tên Task:</label>
                        <input
                            type="text"
                            id="newTaskName"
                            value={data.content}
                            onChange={(e) => setData('content', e.target.value)}
                        />
                    </div>
                    <div>
                        <label htmlFor="time_start">Thời gian bắt đầu</label>
                        <input
                            type="time"
                            id="time_start"
                            name="time_start"
                            value={data.time_start}
                            onChange={(e) => setData('time_start', e.target.value)}
                            className="bg-gray-800"
                        />
                    </div>
                    <div>
                        <label htmlFor="time_end">Thời gian kết thúc</label>
                        <input
                            type="time"
                            id="time_end"
                            name="time_end"
                            value={data.time_end}
                            onChange={(e) => setData('time_end', e.target.value)}
                            className="bg-gray-800"

                        />
                    </div>
                    <PrimaryButton className="mt-4" disabled={processing}>Submit</PrimaryButton>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
