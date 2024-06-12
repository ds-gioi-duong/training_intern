import React from 'react';
import logoSvg from '../../../../public/images/planet/solar_system.svg';

export default function SolarSystem(props) {
    return <img src={logoSvg} alt="Logo" {...props} />;
}
