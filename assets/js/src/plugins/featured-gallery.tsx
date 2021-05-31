import { GalleryImage } from '../contracts/gallery-image';
const React = window.React;
const { compose } = window.wp.compose;
const { MediaUpload, MediaUploadCheck } = window.wp.blockEditor;
const { withSelect, withDispatch } = window.wp.data;
const { PluginDocumentSettingPanel } = window.wp.editPost;
const { Button, Icon } = window.wp.components;

const flexContainer = {
  display: 'flex',
  'flex-wrap': 'wrap',
  marginBottom: '6px'
} as React.CSSProperties;

const flexItem = {
  position: 'relative',
  width: 'calc( 100% / 3 )',
  height: '70px',
} as React.CSSProperties;

const removeBtn = {
  position: 'absolute',
  top: '-6px',
  right: '-6px',
  boxShadow: 'none',
  padding: '6px'
} as React.CSSProperties;

const flexImage = {
  padding: '6px', 
  borderRadius: '8px', 
  height: '100%', 
  objectFit: 'cover', 
  objectPosition: 'center center'
} as React.CSSProperties;

const dispatch = withDispatch( ( dispatch: any, props: any ) => ({

  setMeta: ( images: GalleryImage[] ) => dispatch( 'core/editor' ).editPost({
    meta: { [props.metakey]: images }
  })    
}));

const metaselect = withSelect( ( select: any, props: any ) => ({

  meta: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ props.metakey ]
}));

const Gallery = compose( dispatch, metaselect )(( props: any ) => {

  const { meta, setMeta } = props;

  const addToGallery = ( images: GalleryImage[] ) => {

    const newImages = images.filter( image => ! meta.some(( item: GalleryImage ) => item.id === image.id ) )
        .map( image => ({ id: image.id, url: image.url }) );
      
    meta.forEach(( image: GalleryImage ) => {

      if ( ! newImages.includes( image ) ) {
          
        newImages.push( image ) 
      }
    });

    setMeta( newImages );
  }

  const removeFromGallery = ( id: number ) => {

    const newImages = meta.filter(( item: GalleryImage ) => item.id !== id );

    setMeta( newImages );
  }

  return (
    <PluginDocumentSettingPanel
      name={props.name}
      title={props.title}
    >
      <div style={flexContainer}>
        { meta.length > 0 && meta.map(( image: GalleryImage, i: number ) =>
          <div 
            key={i} 
            style={flexItem}>
            <Button 
              className="is-destructive"
              onClick={() => removeFromGallery( image.id )}
              style={removeBtn}
            >
              <Icon 
                icon="dismiss" 
                style={{ marginRight: 0 }}
              />
            </Button>
            <img 
              src={image.url} 
              style={flexImage}
            />
          </div>
        )}
      </div>
      <MediaUploadCheck fallback="">
        <MediaUpload
          gallery
          multiple
          value={meta.map(( image: GalleryImage ) => image.id )}
          allowedTypes={['image']}
          onSelect={( images: GalleryImage[] ) => addToGallery( images )}
          render={( { open }: { open: boolean } ) => (
            <Button
              className={ 'button' }
              onClick={ open }
            >
              { meta.length > 0 ? 'Edit gallery' : 'Add gallery' }
            </Button>
          )}
        />
      </MediaUploadCheck>
    </PluginDocumentSettingPanel>
  )
});

export const gallery = {
  name: 'featured-gallery',
  config: {
    icon: '',
    render: () => <Gallery 
      metakey="_featured_gallery"
      name="gallerypanel"
      title="Post Gallery"
    />
  }
}