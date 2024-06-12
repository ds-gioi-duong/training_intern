import React from 'react';
import logoSvg from '../../../../public/images/planet/venus.svg';

export default function Venus(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
