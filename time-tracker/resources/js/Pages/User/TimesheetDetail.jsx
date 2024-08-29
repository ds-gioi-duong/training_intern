// resources/js/components/TimesheetDetail.jsx
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Timesheet from "@/Components/Timesheet";
import React, { useState } from "react";
import { useForm, Head, usePage } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import Task from "@/Components/Task";

export default function TimesheetDetail({ timesheet, tasks }) {
    
    const { auth } = usePage().props;
    const [times, setTimes] = useState({ start: "", end: "" });
    const { data, setData, post, processing, reset, errors } = useForm({
        timesheet_id: timesheet.id,
        name: "",
        start: "",
        end: "",
    });
    const handleChange = (e) => {
        const { name, value } = e.target;
        setTimes((prevTimes) => ({
            ...prevTimes,
            [name]: value,
        }));
        setData((prevData) => ({
            ...prevData,
            [`${name}`]: `${timesheet.date} ${value}:00`,
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
                    タイムシート
                </h2>
            }
        >
            <Head title="Timesheet" />
            <Timesheet timesheet={timesheet} />
            <div className="dark:text-white">
                <h1>タイムシートの詳細</h1>
                <p>日: {timesheet.date}</p>

                <h2>タスク</h2>

                <div>
                    {tasks.map((task) => (
                        <Task key={task.id} task={task} timesheet= {timesheet}/>
                    ))}
                </div>

                <h2>困難</h2>
                <p>{timesheet.difficulties}</p>

                <h2>翌日の予定</h2>
                <p>{timesheet.next_day_plans}</p>

                <h2>ノート</h2>
                <p>{timesheet.note}</p>

                <h2>T新しいタスクを追加</h2>
                <form onSubmit={submit}>
                    <div>
                        <label htmlFor="newTaskName">タスク名:</label>
                        <input
                            type="text"
                            id="newTaskName"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            className=" dark:bg-gray-800 bg-white"
                        />
                    </div>
                    <div>
                        <label htmlFor="start_time">開始時間</label>
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
                        <label htmlFor="end_time">終了時間</label>
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
                    提出 
                    </PrimaryButton>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
