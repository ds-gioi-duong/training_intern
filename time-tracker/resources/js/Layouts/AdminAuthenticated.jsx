import React from "react";

import NavLink from "@/Components/NavLink";
const Sidebar = () => {
    return (
        <div className="w-52 bg-white-800 dark:bg-gray-800  h-screen p-4">
            <ul className="space-y-4">
                <li>
                <NavLink
                    href={route("admin.dashboard")}
                    active={route().current("dashboard")}
                >
                    {" "}
                    ダッシュボード{" "}
                </NavLink>
                </li>
                <li>
                <NavLink
                    href={route("admin.user_manager")}
                    active={
                        route().current("admin.user_manager") 
                    }
                >
                     ユーザー管理
                </NavLink>
                </li>
                <li>
                <NavLink
                    href={route("admin.messages")}
                    active={route().current("admin.messages")}
                >
                    メッセージ 
                </NavLink>
                </li>
                <li>
                <NavLink
                  href={route("admin.settings")}
                  active={route().current("admin.settings")}
                  >
                    設定
                </NavLink>
                </li>
                <li>
                <NavLink
                  href={route("admin.logout")}
                    method="post"
                  >
                    ログアウト 
                </NavLink>
                </li>
                
               
                
            </ul>
        </div>
    );
};
const AdminAuthenticated = ({ children, header }) => {
    return (
        <div className="flex">
            <Sidebar />
            <main className="flex-grow">{children}</main>
        </div>
    );
};

export default AdminAuthenticated;
