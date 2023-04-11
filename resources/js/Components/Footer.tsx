export default function Header() {
	return (
		<div className='flex flex-col items-center border-t border-slate-400/10 py-10 sm:flex-row-reverse sm:justify-between'>
			<p className='mt-6 text-slate-500 sm:mt-0'>
				<a
					className='inline-block rounded-lg py-1 px-2 hover:bg-slate-100 hover:text-slate-900 transition'
					href='https://github.com/PreemStudio/badge.sh'
					target='_blank'
				>
					View on GitHub
				</a>
			</p>

			<p className='mt-6 text-slate-500 sm:mt-0'>
				Copyright &copy; {new Date().getFullYear()} Badge. All rights reserved.
			</p>
		</div>
	);
}
