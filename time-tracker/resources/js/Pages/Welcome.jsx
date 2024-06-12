import ApplicationLogo from '@/Components/ApplicationLogo';
import { Sun, Mars, Jupiter, Venus, Saturn, Moon, Mercury, SolarSystem } from '@/Components/planet';
import { Link, Head } from '@inertiajs/react';

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };

    return (
        <>
            <Head title="Welcome" />
            <div className="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                <img
                    id="background"
                    className="absolute -left-20 top-0 max-w-[877px]"
                    src="https://svgshare.com/i/171v.svg"
                />
                <div className="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                    <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                        <header className="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                            <div className="flex lg:justify-center lg:col-start-2">
                                <ApplicationLogo />
                            </div>
                            <nav className="-mx-3 flex flex-1 justify-end">
                                {auth.user ? (<><Link
                                    href={route('dashboard')}
                                    className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Dashboard
                                </Link>
                                    <nav aria-label="breadcrumb">
                                        <ol className="breadcrumb">
                                            {breadcrumbs.map((breadcrumb) => (
                                                <li key={breadcrumb.url} className="breadcrumb-item">
                                                    {breadcrumb.url ? (
                                                        <a href={breadcrumb.url}>{breadcrumb.title}</a>
                                                    ) : (
                                                        <span>{breadcrumb.title}</span>
                                                    )}
                                                </li>
                                            ))}
                                        </ol>
                                    </nav>
                        </>

                        ) : (
                        <>
                            <Link
                                href={route('login')}
                                className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>
                            <Link
                                href={route('register')}
                                className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </>
                                )}
                    </nav>
                </header>
                {auth.user ? (<main className="mt-6">
                    <div className="grid gap-6 lg:grid-cols-2 lg:gap-8 lg:grid-rows-6 ">
                        <div
                            className="flex flex-col items-start lg:row-span-6 gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >
                            <div>
                                <Sun className="w-40 h-40 fill-current text-gray-500" />
                            </div>

                            <div>
                                Tuần :
                            </div>
                        </div>

                        <div

                            className="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >

                            <Moon className="w-20 h-20 fill-current text-gray-500" />
                        </div>

                        <div

                            className="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                        >


                            <Mars className="w-20 h-20 fill-current text-gray-500" />
                        </div>

                        <div className="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <Mercury className="w-20 h-20 fill-current text-gray-500" />
                        </div>
                        <div className="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <Jupiter className="w-20 h-20 fill-current text-gray-500" />
                        </div>
                        <div className="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <Venus className="w-20 h-20 fill-current text-gray-500" />
                        </div>
                        <div className="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                            <Saturn className="w-20 h-20 fill-current text-gray-500" />
                        </div>
                    </div>
                </main>
                ) : (<SolarSystem />)}

                <footer className="py-16 text-center text-sm text-black dark:text-white/70">
                    Yardrat v0.0.1
                </footer>
            </div>
        </div >
            </div >
        </>
    );
}
