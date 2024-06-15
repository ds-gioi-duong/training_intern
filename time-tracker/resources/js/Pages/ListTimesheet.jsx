import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head, usePage} from '@inertiajs/react';
import Timesheet from './Timesheet';
import { Link } from 'react-router-dom';
 
export default function ListTimesheet({ auth, timesheets }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        date: '',
        user_id: auth.user.id, // assuming the user is the one creating the timesheet
        difficulties: '',
        next_day_plans: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('timesheets.store'), { onSuccess: () => reset() });
    };

 
    return (
        <AuthenticatedLayout
        user={auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Timesheet</h2>}
    >
        <Head title="Timesheet" />

        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6 text-gray-900 dark:text-gray-100">{auth.user.username}</div>
                    <form onSubmit={submit}>
                        <div className="mb-4">
                            <label htmlFor="date" className="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">
                                Date:
                            </label>
                            <input
                                type="date"
                                id="date"
                                name="date"
                                value={data.date}
                                onChange={(e) => setData('date', e.target.value)}
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required
                            />
                            <InputError message={errors.date} className="mt-2" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="difficulties" className="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">
                                Difficulties:
                            </label>
                            <textarea
                                id="difficulties"
                                name="difficulties"
                                value={data.difficulties}
                                onChange={(e) => setData('difficulties', e.target.value)}
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            ></textarea>
                            <InputError message={errors.difficulties} className="mt-2" />
                        </div>
                        <div className="mb-4">
                            <label htmlFor="next_day_plans" className="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">
                                Next Day Plans:
                            </label>
                            <textarea
                                id="next_day_plans"
                                name="next_day_plans"
                                value={data.next_day_plans}
                                onChange={(e) => setData('next_day_plans', e.target.value)}
                                className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            ></textarea>
                            <InputError message={errors.next_day_plans} className="mt-2" />
                        </div>
                        <div className="flex items-center justify-center">
                            <PrimaryButton className="mt-4" disabled={processing} >Submit</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
        <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
                    {timesheets.map(timesheet =>
                        <Timesheet key={timesheet.id} timesheet={timesheet} />
                    
                    )}
                </div>
        </div>
    </AuthenticatedLayout>
      );
}