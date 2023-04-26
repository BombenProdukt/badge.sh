import { cn } from '@/lib/utils';
import { forwardRef, InputHTMLAttributes, useEffect, useImperativeHandle, useRef } from 'react';

export default forwardRef(function TextInput(
	{ type = 'text', className = '', isFocused = false, ...props }: InputHTMLAttributes<HTMLInputElement> & {
		isFocused?: boolean;
	},
	ref,
) {
	const localRef = useRef<HTMLInputElement>(null);

	useImperativeHandle(ref, () => ({
		focus: () => localRef.current?.focus(),
	}));

	useEffect(() => {
		if (isFocused) {
			localRef.current?.focus();
		}
	}, []);

	return (
		<input
			{...props}
			type={type}
			className={cn(
				'flex h-10 w-full rounded-md border border-slate-300 bg-transparent py-2 px-3 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:text-slate-50 dark:focus:ring-slate-400 dark:focus:ring-offset-slate-900',
				className,
			)}
			ref={localRef}
		/>
	);
});
