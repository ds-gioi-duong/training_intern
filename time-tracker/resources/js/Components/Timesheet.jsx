import React, { useState } from "react";
import Dropdown from "@/Components/Dropdown";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import { useForm, usePage } from "@inertiajs/react";
import { Link } from "@inertiajs/react";
import {
    Sun,
    Mars,
    Jupiter,
    Venus,
    Saturn,
    Moon,
    Mercury,
    SolarSystem,
} from "@/Components/planet";

dayjs.extend(relativeTime);

export default function Timesheet({ timesheet }) {
    const { auth } = usePage().props;

    const [editing, setEditing] = useState(false);

    const { data, setData, patch, clearErrors, reset, errors } = useForm({
        difficulties: timesheet.difficulties,
        next_day_plans: timesheet.next_day_plans,
    });
    const submit = (e) => {
        e.preventDefault();
        patch(route("timesheets.update",timesheet.id), {
            onSuccess: () => setEditing(false),
        });

    };

    const dayIcons = {
        0: <Sun />, // Chủ nhật
        1: <Moon />, // Thứ hai
        2: <Mars />, // Thứ ba
        3: <Mercury />, // Thứ tư
        4: <Jupiter />, // Thứ năm
        5: <Venus />, // Thứ sáu
        6: <Saturn />, // Thứ bảy
    };
    const dayOfWeek = dayjs(timesheet.date).day();
    const weekday = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    return (
        <div className="p-6 flex space-x-2 bg-white dark:bg-gray-800 overflow-hidden text- sm:rounded-lg text-gray-900 dark:text-gray-100">

            <Link
                href={route("timesheets.show", timesheet.id)}
                alt={weekday[dayOfWeek]}
            >
                {dayIcons[dayOfWeek] &&
                    React.cloneElement(dayIcons[dayOfWeek], {
                        className: "h-8 w-8 -scale-x-100",
                    })}
            </Link>
            <div className="flex-1">
                <div className="flex justify-between items-center">
                    <div>
                        <span >{timesheet.user}</span>
                        <small className="ml-2 text-sm">
                            {dayjs(timesheet.created_at).fromNow()}
                        </small>
                        {timesheet.created_at !== timesheet.updated_at && (
                            <small className="text-sm ">
                                {" "}
                                &middot; edited
                            </small>
                        )}
                    </div>
                    { (
                        <Dropdown>
                            <Dropdown.Trigger>
                                <button>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        className="h-4 w-4 text-gray-400"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </Dropdown.Trigger>
                            <Dropdown.Content>
                                <button
                                    className="block w-full px-4 py-2 text-start text-sm leading-5 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"
                                    onClick={() => setEditing(true)}
                                >
                                    編集 
                                </button>
                                <Dropdown.Link
                                    as="button"
                                    href={route(
                                        "timesheets.destroy",
                                        timesheet.id,
                                    )}
                                    method="delete"
                                >
                                    削除 
                                </Dropdown.Link>
                            </Dropdown.Content>
                        </Dropdown>
                    )}
                </div>
                {editing ? (
                    <form onSubmit={submit}>
                        <textarea
                            value={data.difficulties}
                            onChange={(e) =>
                                setData("difficulties", e.target.value)
                            }
                            className="mt-4 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        ></textarea>
                        <textarea
                            value={data.next_day_plans}
                            onChange={(e) =>
                                setData("next_day_plans", e.target.value)
                            }
                            className="mt-4 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        ></textarea>
                        <InputError message={errors.message} className="mt-2" />
                        <div className="space-x-2">
                            <PrimaryButton className="mt-4">保存 </PrimaryButton>
                            <button
                                className="mt-4"
                                onClick={() => {
                                    setEditing(false);
                                    reset();
                                    clearErrors();
                                }}
                            >
                                キャンセル 
                            </button>
                        </div>
                    </form>
                ) : (
                    <>
                        <p className="mt-4 text-lg ">
                            {timesheet.difficulties}
                        </p>
                        <p className="mt-4 text-lg ">
                            {timesheet.next_day_plans}
                        </p>
                    </>
                )}
            </div>
        </div>
    );
}
