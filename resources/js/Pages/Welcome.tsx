import DangerButton from '@/Components/DangerButton';
import Modal from '@/Components/Modal';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/Components/Select';
import TextInput from '@/Components/TextInput';
import Guest from '@/Layouts/GuestLayout';
import { PageProps } from '@/types';
import { RequestPayload } from '@inertiajs/inertia';
import { Head, router, usePage, useRemember } from '@inertiajs/react';
import { useEffect, useState } from 'react';

export default function Welcome(
	{ badges, categories }: PageProps<{ badges: object; categories: { title: string; value: string }[] }>,
) {
	const rows = [];

	const [customBadge, setCustomBadge] = useState<Record<string, any> | undefined>(undefined);
	const [customBadgeLink, setCustomBadgeLink] = useState<string | undefined>(undefined);
	const [customBadgePreview, setCustomBadgePreview] = useState<string>('');

	for (const { form, identifier, previews, service } of Object.values(badges)) {
		for (const preview of previews) {
			rows.push(
				<tr key={preview.hash} data-key={preview.hash}>
					<td className='whitespace-nowrap py-2 pl-4 pr-3 text-gray-500 sm:pl-0 text-sm'>
						{service}
					</td>
					<td className='whitespace-nowrap px-2 py-2 font-semibold text-gray-900 text-sm'>
						{preview.name}
					</td>
					<td className='whitespace-nowrap px-2 py-2 text-gray-900'>
						<a href={preview.path} target='_blank' dangerouslySetInnerHTML={{ __html: preview.html }}></a>
					</td>
					<td className='relative whitespace-nowrap py-2 pl-3 pr-4 text-right font-medium sm:pr-0 text-sm'>
						<button
							onClick={() => {
								setCustomBadge({
									...form,
									identifier,
									overwrites: {
										label: '',
										labelColor: '',
										message: '',
										messageColor: '',
									},
								});

								setCustomBadgeLink(form.path);
							}}
							type='button'
							className='text-brand-600 transition font-bold hover:text-brand-900'
						>
							Customize
						</button>
					</td>
				</tr>,
			);
		}
	}

	const [formState, setFormState] = useRemember({
		category: (usePage().props.ziggy as any).query.category ?? 'all',
		searchQuery: (usePage().props.ziggy as any).query.searchQuery ?? '',
	});

	const applyFilters = (filters: RequestPayload) => {
		router.get(
			'/',
			filters,
			{
				preserveState: true,
				replace: true,
			},
		);
	};

	const closeModal = () => setCustomBadge(undefined);

	useEffect(() => {
		if (!customBadge) {
			return;
		}

		if (Object.keys(customBadge.route).length > 0) {
			customBadge.path = customBadge.pathPattern;

			for (const [routeKey, routeValue] of Object.entries(customBadge.route)) {
				if (routeValue !== null) {
					customBadge.path = customBadge.path.replaceAll(`{${routeKey}}`, routeValue);
				}
			}
		}

		if (Object.keys(customBadge.query).length > 0) {
			const searchParams: Record<string, any> = {};

			for (const [queryKey, queryValue] of Object.entries(customBadge.query)) {
				if (queryValue !== null) {
					searchParams[queryKey] = queryValue;
				}
			}

			if (Object.keys(searchParams).length > 0) {
				customBadge.path = `${customBadge.path}?${new URLSearchParams(searchParams).toString()}`;
			}
		}

		setCustomBadgeLink(`${window.location.origin}${customBadge.path}`);

		const fetchVector = async () => {
			const response = await fetch(
				`/internal/preview/${customBadge.identifier}?${
					new URLSearchParams({
						...customBadge.query,
						...customBadge.route,
						...customBadge.overwrites,
					}).toString()
				}`,
			);

			if (response.status === 200) {
				setCustomBadgePreview(
					await (
						await fetch(
							`/internal/preview/${customBadge.identifier}?${
								new URLSearchParams({
									...customBadge.query,
									...customBadge.route,
									...customBadge.overwrites,
								}).toString()
							}`,
						)
					).text(),
				);
			}
		};

		fetchVector().catch(console.error);
	}, [customBadge]);

	return (
		<Guest>
			<Head title='Welcome' />

			<div className='mt-16'>
				<div className='flex justify-between gap-4'>
					<Select
						value={formState.category}
						onValueChange={(e) => {
							setFormState({ ...formState, category: e });

							applyFilters({ ...formState, category: e });
						}}
					>
						<SelectTrigger className='w-[180px]'>
							<SelectValue placeholder='Select a category' />
						</SelectTrigger>
						<SelectContent>
							<SelectGroup>
								<SelectItem key='all' value='all'>All</SelectItem>
								{categories.map(({ title, value }) => <SelectItem key={value} value={value}>{title}</SelectItem>)}
							</SelectGroup>
						</SelectContent>
					</Select>

					<TextInput
						onChange={(e) => {
							setFormState({ ...formState, searchQuery: e.target.value });

							applyFilters({ ...formState, searchQuery: e.target.value });
						}}
						placeholder='Search...'
					/>
				</div>

				<table className='min-w-full divide-y divide-gray-100 mt-4'>
					<thead>
						<tr className='border-gray-100 border-t'>
							<th scope='col' className='whitespace-nowrap py-3.5 pl-4 pr-3 text-left font-bold text-gray-900 sm:pl-0'>
								Service
							</th>
							<th scope='col' className='whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900'>
								Descriptor
							</th>
							<th scope='col' className='whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900'>Preview</th>
							<th scope='col' className='whitespace-nowrap px-2 py-3.5 text-left font-bold text-gray-900'></th>
						</tr>
					</thead>

					<tbody className='divide-y divide-gray-100 bg-white'>
						{rows}
					</tbody>
				</table>
			</div>

			{customBadge && (
				<Modal show={customBadge !== undefined} onClose={closeModal}>
					<div className='p-6'>
						<div className='mb-4'>
							<TextInput
								type='text'
								className='block w-full rounded-md border-0 py-1.5 text-gray-900 bg-gray-50 cursor-not-allowed shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6'
								readOnly
								value={customBadgeLink}
							/>

							<div className='mt-2 flex justify-center' dangerouslySetInnerHTML={{ __html: customBadgePreview }}></div>
						</div>

						{Object.keys(customBadge?.route).map(key => (
							<div className='sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2' key={key}>
								<label className='block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5'>
									{key}
								</label>
								<div className='mt-2 sm:col-span-2 sm:mt-0'>
									<TextInput
										type='text'
										value={customBadge.route[key] ?? ''}
										onChange={(e) => {
											setCustomBadge({
												...customBadge,
												route: {
													...customBadge.route,
													[key]: e.target.value,
												},
											});
										}}
									/>
								</div>
							</div>
						))}

						{Object.keys(customBadge.query).map(key => (
							<div className='sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2' key={key}>
								<label className='block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5'>
									{key}
								</label>
								<div className='mt-2 sm:col-span-2 sm:mt-0'>
									<TextInput
										type='text'
										value={customBadge.query[key] ?? ''}
										onChange={(e) => {
											setCustomBadge({
												...customBadge,
												query: {
													...customBadge.query,
													[key]: e.target.value,
												},
											});
										}}
									/>
								</div>
							</div>
						))}

						<div className='sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2'>
							<label className='block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5'>
								Label
							</label>
							<div className='mt-2 sm:col-span-2 sm:mt-0'>
								<TextInput
									type='text'
									value={customBadge.overwrites.label}
									onChange={(e) => {
										setCustomBadge({
											...customBadge,
											overwrites: {
												...customBadge.overwrites,
												label: e.target.value,
											},
										});
									}}
								/>
							</div>
						</div>

						<div className='sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2'>
							<label className='block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5'>
								Label Color
							</label>
							<div className='mt-2 sm:col-span-2 sm:mt-0'>
								<TextInput
									type='text'
									value={customBadge.overwrites.labelColor}
									onChange={(e) => {
										setCustomBadge({
											...customBadge,
											overwrites: {
												...customBadge.overwrites,
												labelColor: e.target.value,
											},
										});
									}}
								/>
							</div>
						</div>

						<div className='sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2'>
							<label className='block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5'>
								Message
							</label>
							<div className='mt-2 sm:col-span-2 sm:mt-0'>
								<TextInput
									type='text'
									value={customBadge.overwrites.message}
									onChange={(e) => {
										setCustomBadge({
											...customBadge,
											overwrites: {
												...customBadge.overwrites,
												message: e.target.value,
											},
										});
									}}
								/>
							</div>
						</div>

						<div className='sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-2'>
							<label className='block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5'>
								Message Color
							</label>
							<div className='mt-2 sm:col-span-2 sm:mt-0'>
								<TextInput
									type='text'
									value={customBadge.overwrites.messageColor}
									onChange={(e) => {
										setCustomBadge({
											...customBadge,
											overwrites: {
												...customBadge.overwrites,
												messageColor: e.target.value,
											},
										});
									}}
								/>
							</div>
						</div>

						<div className='mt-6 flex justify-end'>
							<DangerButton type='button' onClick={closeModal}>
								Close
							</DangerButton>
						</div>
					</div>
				</Modal>
			)}
		</Guest>
	);
}
