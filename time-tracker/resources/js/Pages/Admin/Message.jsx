import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import Table from '@/Components/Table/Table';
import AdminAuthenticated from '@/Layouts/AdminAuthenticated';

export default function Dashboard({ auth ,data}) {
    return (
        <AdminAuthenticated
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Admin </h2>}
        >
            <Head title="Admin-Massage" />
            
        </AdminAuthenticated>
    );
}
