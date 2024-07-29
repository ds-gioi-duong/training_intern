// resources/js/components/TimesheetDetail.jsx
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import React, { useState } from 'react';
import { useForm, Head, usePage } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';

export default function TimesheetDetail({ timesheet , tasks}) {
    const { auth } = usePage().props;
    const { data, setData, post, processing, reset, errors } = useForm({
        timesheet_id: timesheet.id,
        content: '',
        start_time: '',
        end_time: '',
    });

    const submit = async (e) => {
        e.preventDefault();
        //chuyển đổi từ giờ sang timestamp
        const start_time = new Date(timesheet.date + 'T' + data.start_time + ':00Z').toISOString();
        const end_time = new Date(timesheet.date + 'T' + data.end_time + ':00Z').toISOString();
        setData(prevData => ({
            ...prevData,
            start_time: start_time,
            end_time: end_time
        }), async () => {
            try {
                await post(route('tasks.store', timesheet, { absolute: false }), { onSuccess: reset });
            } catch (error) {
                console.error(error);
            }
        });
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
                {tasks.map((task, index) => (

                    <div key={index} className="border-b border-gray-200 py-4">
                        <p><strong>Thời gian:  {task.time_spent}</strong></p>
                        <p><strong>Task ID:</strong> {task.id ? task.id : 'N/A'}</p>
                        <p><strong>Nội dung task:</strong> {task.content}</p>
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
                            className=" dark:bg-gray-800 bg-white"
                        />
                    </div>
                    <div>
                        <label htmlFor="time_start">Thời gian bắt đầu</label>
                        <input
                            type="time"
                            id="start_time"
                            name="start_time"
                            value={data.start_time}
                            onChange={(e) => setData('start_time', e.target.value )}
                            className="dark:bg-gray-800 bg-white"
                        />
                    </div>
                    <div>
                        <label htmlFor="end_time">Thời gian kết thúc</label>
                        <input
                            type="time"
                            id="end_time"
                            name="end_time"
                            value={data.end_time}
                            onChange={(e) => setData('end_time', e.target.value)}
                            className="bg-gray-800"

                        />
                    </div>
                    <PrimaryButton className="mt-4" disabled={processing}>Submit</PrimaryButton>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
