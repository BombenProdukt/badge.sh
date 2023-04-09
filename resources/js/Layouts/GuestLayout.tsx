import Footer from '@/Components/Footer.js';
import Header from '@/Components/Header.js';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
	return (
		<main className='max-w-7xl mx-auto pt-16'>
			<Header />

			{children}

			<Footer />
		</main>
	);
}
