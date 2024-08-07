import React, { useState } from "react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { useForm, usePage } from "@inertiajs/react";
import { Link } from "@inertiajs/react";

export default function Task({ task }) {
    const [editing, setEditing] = useState(false);
    const { data, setData, patch, clearErrors, reset, errors } = useForm({
        name: task.name,
    });
    const handleSubmit = (e) => {
        e.preventDefault();
        patch(route("tasks.update", task.id), {
            onSuccess: () => setEditing(false),
        });
    };

    return (
        <div id={task.id} className="p-6 flex space-x-2">
            <div className="flex-1">
                <div className="flex justify-between items-center">
                    <div>
                        <small className="ml-2 text-sm text-gray-600">{`${task.start}-${task.end}`}</small>
                        {task.created_at !== task.updated_at && (
                            <small className="text-sm text-gray-600">
                                {" "}
                                &middot; edited
                            </small>
                        )}
                    </div>
                    <button
                        className="block w-full px-4 py-2 text-start text-sm leading-5 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"
                        onClick={() => setEditing(true)}
                    >
                        編集
                    </button>

                    <Link
                        as="button"
                        href={route("tasks.destroy", task.id)}
                        method="delete"
                        className="ml-2 px-4 py-2 bg-red-600 text-white rounded"
                    >
                        削除
                    </Link>
                </div>

                {editing ? (
                    <form onSubmit={handleSubmit}>
                        <textarea
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            className="w- full mt-2 p-2 border border-gray-300 rounded"
                        ></textarea>
                        <InputError message={errors.name} className="mt-2" />
                        <div className="space-x-2 mt-4">
                            <PrimaryButton>保存</PrimaryButton>
                            <button
                                className="mt-4 px-4 py-2 border border-gray-300 rounded"
                                onClick={() => {
                                    setEditing(false);
                                    reset();
                                    clearErrors();
                                    console.log("cancel");
                                }}
                            >
                                キャンセル
                            </button>
                        </div>
                    </form>
                ) : (
                    <p className="mt-4 text-lg text-gray-900">{task.name}</p>
                )}
            </div>
        </div>
    );
}
