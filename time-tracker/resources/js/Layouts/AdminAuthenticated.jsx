import React from "react";
import { Link } from "@inertiajs/inertia-react";

const Sidebar = () => {
    return (
        <div className="w-52 bg-gray-800 h-screen p-4">
            <ul className="space-y-4">
                <li>
                <NavLink
                    href={route("dashboard")}
                    active={route().current("dashboard")}
                >
                    {" "}
                    ダッシュボード{" "}
                </NavLink>
                </li>
                <li>
                <NavLink
                    href={route("user-manager")}
                    active={
                        route().current("user-manager") 
                    }
                >
                    概要
                </NavLink>
                </li>
                <li>
                <NavLink
                    href={route("message")}
                    active={route().current("message")}
                >
                    今日
                </NavLink>
                </li>
                
               
                
            </ul>
        </div>
    );
};
const AdminAuthenticated = ({ children, header }) => {
    return (
        <div>
            <Sidebar />
            <main>{children}</main>
        </div>
    );
};

export default AdminAuthenticated;
