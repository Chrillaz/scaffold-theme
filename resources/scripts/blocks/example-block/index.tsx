const { React } = window;

const exampleBlock = {
  apiVersion: 2,
  title: 'Example Block',
  icon: 'search', // https://developer.wordpress.org/resource/dashicons/#plugins-checked
  description: 'Example block template',
  category: 'noor-theme-blocks',
  example: {},
  attributes: {
  },
  edit: ( props: any ) => <div>Example Block</div>,
  save: ( props: any ) => <div>Example Block</div>
}

export {
  exampleBlock
}