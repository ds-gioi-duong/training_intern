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
            <Head title="Admin-Dashboard" />
            <div className='bg-blue-800 dark:bg-white-100 ' style={{ width: '100%', height: '100%' }}>Dashboard page</div>
        </AdminAuthenticated>
    );
}
