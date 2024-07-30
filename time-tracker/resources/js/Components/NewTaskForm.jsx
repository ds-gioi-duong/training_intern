import React, { useState } from "react";
import { useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";

export default function NewTaskForm({ timesheet }) {
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
            onSuccess: () => reset()
        });

        setTimes({ start: "", end: "" });
    };

    return (
        <>
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
        </>
    );
}
