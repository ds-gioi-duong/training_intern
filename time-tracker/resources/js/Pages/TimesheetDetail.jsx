// resources/js/components/TimesheetDetail.jsx
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { useForm, Head, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import Task from "@/Components/Task";

export default function TimesheetDetail({ timesheet, tasks }) {
    const { auth } = usePage().props;
    const handleDelete = (taskId) => {
        setTasks(tasks.filter((task) => task.id !== taskId));
    };

    const [times, setTimes] = useState({ start: "", end: "" });
    const { data, setData, post, processing, reset, errors } = useForm({
        timesheet_id: timesheet.id,
        content: "",
        start_time: "",
        end_time: "",
    });
    const handleChange = (e) => {
        const { name, value } = e.target;
        setTimes((prevTimes) => ({
            ...prevTimes,
            [name]: value,
        }));
        setData((prevData) => ({
            ...prevData,
            [`${name}_time`]: `${timesheet.date} ${value}:00`,
        }));
    };

    const submit = async (e) => {
        e.preventDefault();

        post(route("tasks.store", timesheet), {
            onSuccess: () => {
                reset();
            },
        });
        setTimes({ start: "", end: "" });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Timesheet
                </h2>
            }
        >
            <Head title="Timesheet" />

            <div className="dark:text-white">
                <h1>Chi tiết Timesheet</h1>
                <p>ID: {timesheet.id}</p>
                <p>Ngày: {timesheet.date}</p>

                <h2>Các công việc đã làm trong ngày</h2>

                <div>
                    {tasks.map((task) => (
                        <Task
                            key={task.id}
                            task={task}
                            onDelete={handleDelete}
                        />
                    ))}
                </div>

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
                            onChange={(e) => setData("content", e.target.value)}
                            className=" dark:bg-gray-800 bg-white"
                        />
                    </div>
                    <div>
                        <label htmlFor="start_time">Thời gian bắt đầu</label>
                        <input
                            type="time"
                            id="start_time"
                            name="start"
                            value={times.start}
                            onChange={handleChange}
                            className="dark:bg-gray-800 bg-white"
                        />
                    </div>
                    <div>
                        <label htmlFor="end_time">Thời gian kết thúc</label>
                        <input
                            type="time"
                            id="end_time"
                            name="end"
                            value={times.end}
                            onChange={handleChange}
                            className="bg-gray-800"
                        />
                    </div>
                    <PrimaryButton className="mt-4" disabled={processing}>
                        Submit
                    </PrimaryButton>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
