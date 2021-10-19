interface Window {
    wp: any;
    _wpLoadBlockEditor: Promise<void>;
    _themePalette: {
        name: string;
        slug: string;
        color: string;
    }[];

}

interface IBlockProps {
    attributes: { [key: string]: any };
    clientId: string;
    context: { [key: string]: any };
    isSelected: boolean;
    isSelectionEnabled: boolean;
    name: string;
    [key: string]: any;
}

interface IPostType {
    capabilities: { [key: string]: string };
    description: string;
    hierarchical: boolean;
    labels: { [key: string]: string };
    name: string
    rest_base: string;
    slug: string;
    supports: { [key: string]: boolean };
    taxonomies: string[];
    viewable: boolean;
}

interface ITerm {
    count: number;
    description: string;
    id: number;
    link: string;
    meta: any[];
    name: string;
    parent: number;
    slug: string;
    taxonomy: string;
}

interface IPost {
    content: {
        raw: string;
        rendered: string;
        protected: boolean;
        block_version: number;
    };
    date: string;
    date_gmt: string;
    featured_media: number;
    id: number;
    link: string;
    meta: { [key: string]: any };
    modified: string;
    modified_gmt: string;
    password: string;
    permalink_template: string;
    slug: string;
    status: string;
    template: string;
    title: {
        raw: string;
        rendered: string;
    };
    type: string
}
