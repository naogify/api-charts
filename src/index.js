import { registerBlockType } from '@wordpress/blocks';

registerBlockType( 'myguten/test-block', {
    title: 'Basic Example',
    icon: 'smiley',
    category: 'layout',
    edit: () => <div>Hello, Gutenberg!</div>,
    save: () => <div>Hello, Gutenberg!</div>,
} );
