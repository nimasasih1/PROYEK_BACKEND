import svgPaths from "./imports/svg-v73oe5k7gh";
import imgHorizon22 from "figma:asset/ffda6eaf79162736ec17ef77baf834a6e92c0b3f.png";
import imgDownload from "figma:asset/47b443bee23f5a20e1cc0a949dbdf9e6b0c0f7d9.png";
import imgFrame63 from "figma:asset/40afd339e1c90f4d193ad69856c8fd65178f791c.png";
import img9124D5B5C9124896Aa4D5477Ba06A19B1 from "figma:asset/252ed262ade6df999b214ffb42362f05828720e7.png";
import imgUnsplashWT1VDxb6Io from "figma:asset/799efa0b38bbb6e8230d8e9a835a81042ce1dbff.png";

function Header() {
  return (
    <div className="absolute bg-[rgba(255,255,255,0.1)] h-[62px] left-0 overflow-hidden shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] top-0 w-[1440px] z-50">
      <p className="absolute font-['Inter:Regular',_sans-serif] font-normal leading-[normal] left-[191px] not-italic text-[12px] text-black text-nowrap top-[47px] whitespace-pre">&nbsp;</p>
      
      {/* Navigation */}
      <div className="absolute box-border flex gap-[30px] items-center left-[1080px] p-[10px] top-[9px]">
        <button className="cursor-pointer font-['Raleway:SemiBold',_sans-serif] font-semibold leading-[0] text-[#980517] text-[20px] text-nowrap">
          <p className="leading-[normal] whitespace-pre">Home</p>
        </button>
        <button className="cursor-pointer font-['Raleway:SemiBold',_sans-serif] font-semibold leading-[0] text-[20px] text-black text-nowrap">
          <p className="leading-[normal] whitespace-pre">Schedule</p>
        </button>
        <button className="cursor-pointer font-['Raleway:SemiBold',_sans-serif] font-semibold leading-[0] text-[20px] text-black text-nowrap">
          <p className="leading-[normal] whitespace-pre">Media</p>
        </button>
        <div className="relative size-[24px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 24 24">
            <g clipPath="url(#clip0_1_169)">
              <path d={svgPaths.p2785da80} fill="black" />
            </g>
            <defs>
              <clipPath id="clip0_1_169">
                <rect fill="white" height="24" width="24" />
              </clipPath>
            </defs>
          </svg>
        </div>
      </div>
      
      {/* Logo */}
      <div className="absolute flex gap-[6px] h-[63px] items-center left-[20px] top-0 w-[351px]">
        <div className="h-[42px] relative w-[45px]">
          <div className="absolute inset-0 overflow-hidden pointer-events-none">
            <img alt="" className="absolute h-[238.5%] left-[1.47%] max-w-none top-[-74.8%] w-[561.94%]" src={imgHorizon22} />
          </div>
        </div>
        <div className="h-[22px] relative w-[312px]">
          <div className="absolute inset-0 overflow-hidden pointer-events-none">
            <img alt="" className="absolute h-[682.97%] left-[-22.44%] max-w-none top-[-264.21%] w-[122.44%]" src={imgHorizon22} />
          </div>
        </div>
      </div>
    </div>
  );
}

function HeroSection() {
  return (
    <div className="absolute bg-[#f7f7f7] h-[794px] left-0 overflow-hidden top-[-63px] w-[1440px]">
      {/* Background Circle */}
      <div className="absolute h-[818px] top-[-58px] w-[844px]" style={{ left: "calc(56.25% - 15px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 844 818">
          <path d={svgPaths.p37b0bd00} fill="#980517" fillOpacity="0.1" />
        </svg>
      </div>
      
      {/* Shadow Element */}
      <div className="absolute flex h-[32.796px] items-center justify-center top-[712px] w-[39.159px]" style={{ left: "calc(81.25% - 14px)" }}>
        <div className="flex-none rotate-[15.402deg]">
          <div className="h-[24.712px] relative w-[33.824px]">
            <div className="absolute inset-[-40.47%_-29.57%]">
              <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 54 45">
                <g filter="url(#filter0_f_1_218)">
                  <path d={svgPaths.p1a5a5200} fill="black" fillOpacity="0.42" />
                </g>
                <defs>
                  <filter colorInterpolationFilters="sRGB" filterUnits="userSpaceOnUse" height="44.7117" id="filter0_f_1_218" width="53.8235" x="0" y="0">
                    <feFlood floodOpacity="0" result="BackgroundImageFix" />
                    <feBlend in="SourceGraphic" in2="BackgroundImageFix" mode="normal" result="shape" />
                    <feGaussianBlur result="effect1_foregroundBlur_1_218" stdDeviation="5" />
                  </filter>
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </div>
      
      {/* Character Illustration */}
      <div className="absolute h-[645px] top-[124px] w-[508px]" style={{ left: "calc(62.5% + 19px)" }}>
        <div className="absolute inset-0 overflow-hidden pointer-events-none">
          <img alt="Graduate character" className="absolute h-[104.18%] left-[-88.98%] max-w-none top-[-0.01%] w-[188.98%]" src={imgDownload} />
        </div>
      </div>
      
      {/* Main Text Content */}
      <div className="absolute flex flex-col gap-[20px] items-start left-[110px] text-black top-[310px] w-[786px]">
        <div className="flex flex-col items-start leading-[0] relative w-full">
          <p className="font-['Raleway:Regular',_sans-serif] font-normal leading-[normal] relative text-[50px] w-full">
            <span className="text-[#980517]">Graduation</span>
            <span> System</span>
          </p>
          <p className="font-['Raleway:SemiBold',_sans-serif] font-semibold leading-[normal] relative text-[60px] w-full">
            <span>Horizon </span>
            <span className="text-[#980517]">University</span>
            <span> Indonesia</span>
          </p>
        </div>
        <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] relative text-[20px] w-[695px]">
          Horizon University's graduation system that facilitates access to schedules, information, and graduation documentation
        </p>
      </div>
    </div>
  );
}

function GraduationScheduleSection() {
  return (
    <div className="absolute bg-white h-[688px] left-0 overflow-hidden top-[751px] w-[1440px]">
      {/* Background Circle */}
      <div className="absolute left-[-34px] size-[519px] top-[28px]">
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 519 519">
          <path d={svgPaths.p25d9f900} fill="#980517" fillOpacity="0.1" />
        </svg>
      </div>
      
      {/* Background Image */}
      <div className="absolute h-[622px] left-[-140px] top-[40px] w-[933px]">
        <img alt="" className="absolute inset-0 max-w-none object-cover pointer-events-none size-full" src={img9124D5B5C9124896Aa4D5477Ba06A19B1} />
      </div>
      
      {/* Content */}
      <div className="absolute flex flex-col gap-[10px] items-start text-black top-[71px] w-[668px]" style={{ left: "calc(43.75% + 21px)" }}>
        <div className="flex flex-col items-start relative w-[668px]">
          <p className="font-['Raleway:Regular',_sans-serif] font-normal leading-[normal] min-w-full relative text-[44px]" style={{ width: "min-content" }}>
            Information
          </p>
          <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] relative text-[62px] w-[668px]">
            <span>Graduation </span>
            <span className="text-[#980517]">Schedule</span>
          </p>
        </div>
        <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] min-w-full relative text-[20px]" style={{ width: "min-content" }}>
          Check the latest graduation schedule for each study program so that your precious moment runs smoothly.
        </p>
      </div>
      
      {/* Schedule Card */}
      <div className="absolute h-[207px] overflow-hidden rounded-[100px] top-[340px] w-[668px]" style={{ left: "calc(43.75% + 21px)" }}>
        <div className="absolute inset-0 pointer-events-none rounded-[100px]">
          <div className="absolute inset-0 overflow-hidden rounded-[100px]">
            <img alt="" className="absolute h-[260.11%] left-0 max-w-none top-[-145.91%] w-full" src={imgFrame63} />
          </div>
          <div className="absolute bg-[rgba(152,5,23,0.8)] inset-0 rounded-[100px]" />
        </div>
        
        {/* Date */}
        <p className="absolute font-['Radio_Canada:SemiBold',_sans-serif] font-semibold leading-[normal] text-[#f5e6e8] text-[60px] text-nowrap top-[68px] whitespace-pre" style={{ left: "calc(50% - 139px)", fontVariationSettings: "'wdth' 100" }}>
          20 Jan 25
        </p>
        
        {/* Calendar Icon */}
        <div className="absolute left-1/2 size-[40px] top-[28px] translate-x-[-50%]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 40 40">
            <g clipPath="url(#clip0_1_187)">
              <path d={svgPaths.p1a002800} fill="#F5E6E8" />
              <path d={svgPaths.p1187be80} fill="#F5E6E8" />
              <path d={svgPaths.p1068fc00} fill="#F5E6E8" />
              <path d={svgPaths.p25b49280} fill="#F5E6E8" />
              <path d={svgPaths.p1011c980} fill="#F5E6E8" />
              <path d={svgPaths.p16efd700} fill="#F5E6E8" />
              <path d={svgPaths.p3d3ace80} fill="#F5E6E8" />
              <path d={svgPaths.pa6b9300} fill="#F5E6E8" />
              <path d={svgPaths.p281ede30} fill="#F5E6E8" />
              <path d={svgPaths.p1f5bef00} fill="#F5E6E8" />
              <path d={svgPaths.p3cc7b540} fill="#F5E6E8" />
              <path d={svgPaths.p39588d80} fill="#F5E6E8" />
              <path d={svgPaths.p8da6600} fill="#F5E6E8" />
              <path d={svgPaths.p3b847400} fill="#F5E6E8" />
              <path d={svgPaths.p55418b0} fill="#F5E6E8" />
              <path d={svgPaths.p3319300} fill="#F5E6E8" />
            </g>
            <defs>
              <clipPath id="clip0_1_187">
                <rect fill="white" height="40" width="40" />
              </clipPath>
            </defs>
          </svg>
        </div>
        
        {/* Location */}
        <div className="absolute flex gap-[10px] items-center top-[140px] translate-x-[-50%]" style={{ left: "calc(50% + 0.5px)" }}>
          <div className="overflow-hidden relative size-[24px]">
            <div className="absolute inset-[8.33%_12.5%_0.78%_12.5%]">
              <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 22">
                <g>
                  <path clipRule="evenodd" d={svgPaths.p27e5ef00} fill="#F5E6E8" fillRule="evenodd" />
                </g>
              </svg>
            </div>
          </div>
          <p className="font-['Radio_Canada:SemiBold',_sans-serif] font-semibold leading-[normal] relative text-[#f5e6e8] text-[20px] text-nowrap whitespace-pre" style={{ fontVariationSettings: "'wdth' 100" }}>
            Resinda Hotel -Karawang
          </p>
        </div>
      </div>
    </div>
  );
}

function StatisticsSection() {
  return (
    <div className="absolute bg-[#980517] h-[305px] left-0 overflow-hidden top-[1459px] w-[1440px]">
      {/* Graduates */}
      <div className="absolute flex items-end left-[130px] top-[93px]">
        <div className="relative size-[87px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 87 87">
            <g>
              <path d={svgPaths.p24e3af80} fill="#FDFDFD" />
            </g>
          </svg>
        </div>
        <p className="font-['Radio_Canada:SemiBold',_sans-serif] font-semibold leading-[normal] relative text-[60px] text-nowrap text-white whitespace-pre" style={{ fontVariationSettings: "'wdth' 100" }}>
          5.025
        </p>
      </div>
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] left-[205px] text-[#fdfdfd] text-[20px] text-nowrap top-[190px] whitespace-pre">Graduates</p>
      <div className="absolute h-0 left-[145px] top-[185px] w-[232px]">
        <div className="absolute bottom-0 left-0 right-0 top-[-1px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 232 1">
            <line stroke="#FDFDFD" x2="232" y1="0.5" y2="0.5" />
          </svg>
        </div>
      </div>
      
      {/* Active Students */}
      <div className="absolute flex gap-[13px] items-end left-[596px] top-[93px]">
        <div className="relative size-[87px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 87 87">
            <g>
              <path d={svgPaths.p1b4dbd00} fill="white" />
              <path d={svgPaths.p32776800} fill="white" />
              <path d={svgPaths.p26cc7e00} fill="white" />
              <path d={svgPaths.p3f15f200} fill="white" />
            </g>
          </svg>
        </div>
        <p className="font-['Radio_Canada:SemiBold',_sans-serif] font-semibold leading-[normal] relative text-[60px] text-nowrap text-white whitespace-pre" style={{ fontVariationSettings: "'wdth' 100" }}>
          5.025
        </p>
      </div>
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] left-[657px] text-[#fdfdfd] text-[20px] text-nowrap top-[190px] whitespace-pre">Active Student</p>
      <div className="absolute h-0 left-[599px] top-[185px] w-[257px]">
        <div className="absolute bottom-0 left-0 right-0 top-[-1px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 257 1">
            <line stroke="#FDFDFD" x2="257" y1="0.5" y2="0.5" />
          </svg>
        </div>
      </div>
      
      {/* Prospective Graduates */}
      <div className="absolute flex items-end left-[1062px] top-[93px]">
        <div className="relative size-[87px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 87 87">
            <g>
              <path d={svgPaths.p24e3af80} fill="#FDFDFD" />
            </g>
          </svg>
        </div>
        <p className="font-['Radio_Canada:SemiBold',_sans-serif] font-semibold leading-[normal] relative text-[60px] text-nowrap text-white whitespace-pre" style={{ fontVariationSettings: "'wdth' 100" }}>
          5.025
        </p>
      </div>
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] left-[1086px] text-[#fdfdfd] text-[20px] text-nowrap top-[190px] whitespace-pre">Prospective Graduates</p>
      <div className="absolute h-0 left-[1077px] top-[185px] w-[232px]">
        <div className="absolute bottom-0 left-0 right-0 top-[-1px]">
          <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 232 1">
            <line stroke="#FDFDFD" x2="232" y1="0.5" y2="0.5" />
          </svg>
        </div>
      </div>
    </div>
  );
}

function GraduationMediaSection() {
  return (
    <div className="absolute bg-[#f7f7f7] h-[756px] left-0 overflow-hidden top-[1765px] w-[1440px]">
      {/* Background Circle */}
      <div className="absolute h-[619px] top-[81px] w-[653px]" style={{ left: "calc(75% - 55px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 653 619">
          <path d={svgPaths.p1c08cd80} fill="#980517" fillOpacity="0.1" />
        </svg>
      </div>
      
      {/* Media Image */}
      <div className="absolute h-[455px] left-[88px] overflow-hidden top-[185px] w-[1264px]">
        <div className="absolute h-[1200px] left-0 top-[-300px] w-[1264px]">
          <img alt="Graduation Media" className="absolute inset-0 max-w-none object-cover pointer-events-none size-full" src={imgUnsplashWT1VDxb6Io} />
        </div>
      </div>
      
      <p className="absolute font-['Raleway:SemiBold',_sans-serif] font-semibold leading-[normal] text-[#980517] text-[50px] text-nowrap top-[81px] whitespace-pre" style={{ left: "calc(25% + 112px)" }}>
        GRADUATION MEDIA
      </p>
      
      {/* Pagination Dots */}
      <div className="absolute size-[18px] top-[657px]" style={{ left: "calc(50% - 9px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#980517" r="9" />
        </svg>
      </div>
      <div className="absolute size-[18px] top-[657px]" style={{ left: "calc(43.75% + 56px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#D9D9D9" r="9" />
        </svg>
      </div>
      <div className="absolute size-[18px] top-[657px]" style={{ left: "calc(50% + 16px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#D9D9D9" r="9" />
        </svg>
      </div>
      <div className="absolute size-[18px] top-[657px]" style={{ left: "calc(50% + 41px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#D9D9D9" r="9" />
        </svg>
      </div>
    </div>
  );
}

function TestimonialsSection() {
  return (
    <div className="absolute bg-white h-[800px] left-0 overflow-hidden top-[2521px] w-[1440px]">
      {/* Our Reach Badge */}
      <div className="absolute bg-[rgba(152,5,23,0.2)] box-border flex gap-[10px] items-center justify-center px-[22px] py-[10px] rounded-[8px] translate-y-[-50%]" style={{ top: "calc(50% - 304.5px)", left: "calc(43.75% + 19px)" }}>
        <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] relative text-[#980517] text-[20px] text-nowrap whitespace-pre">Our Reach</p>
      </div>
      
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] text-[70px] text-black text-nowrap top-[141px] whitespace-pre" style={{ left: "calc(12.5% + 127px)" }}>
        <span>What </span>
        <span className="text-[#980517]">Our</span>
        <span> Graduates Say!</span>
      </p>
      
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium h-[23px] leading-[normal] text-[20px] text-black top-[247px] w-[983px]" style={{ left: "calc(6.25% + 147px)" }}>
        Graduation is a proud milestone — discover inspiring stories from Horizon University Indonesia graduates
      </p>
      
      {/* Testimonial Cards */}
      {/* Card 1 - Empty */}
      <div className="absolute h-[300px] rounded-[14px] top-[316px] w-[428px]" style={{ left: "calc(31.25% + 56px)" }}>
        <div className="h-[300px] overflow-hidden relative w-[428px]">
          <p className="absolute font-['Raleway:ExtraLight',_sans-serif] font-extralight leading-[normal] left-[23px] text-[#980517] text-[160px] text-nowrap top-0 whitespace-pre">"</p>
        </div>
        <div className="absolute border border-[#980517] border-solid inset-0 pointer-events-none rounded-[14px]" />
      </div>
      
      {/* Card 2 - Nimas */}
      <div className="absolute bg-white h-[300px] rounded-[14px] top-[316px] w-[428px]" style={{ left: "calc(68.75% - 44px)" }}>
        <div className="h-[300px] leading-[normal] overflow-hidden relative w-[428px]">
          <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium text-[#473f3d] text-[20px] top-[85px] w-[293px]" style={{ left: "calc(50% - 137px)" }}>
            Horizon University Indonesia shaped me into a person who is ready to face the working world.
          </p>
          <p className="absolute font-['Raleway:ExtraLight',_sans-serif] font-extralight left-[17px] text-[#980517] text-[160px] text-nowrap top-0 whitespace-pre">"</p>
          <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium text-[#980517] text-[20px] top-[209px] w-[62px]" style={{ left: "calc(50% - 21px)" }}>
            Nimas
          </p>
          <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium text-[#473f3d] text-[20px] top-[232px] w-[156px]" style={{ left: "calc(50% - 68px)" }}>
            2025 - Graduate
          </p>
        </div>
        <div className="absolute border border-[#980517] border-solid inset-0 pointer-events-none rounded-[14px]" />
      </div>
      
      {/* Card 3 - Ririn (rotated) */}
      <div className="absolute flex h-[300px] items-center justify-center left-[66px] top-[316px] w-[428px]">
        <div className="flex-none rotate-[180deg] scale-y-[-1]">
          <div className="bg-white h-[300px] relative rounded-[14px] w-[428px]">
            <div className="h-[300px] overflow-hidden relative w-[428px]">
              <div className="absolute flex items-center justify-center top-[85px] w-[293px]" style={{ left: "calc(50% - 146px)" }}>
                <div className="flex-none rotate-[180deg] scale-y-[-1]">
                  <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] relative text-[#473f3d] text-[20px] w-[293px]">Horizon University Indonesia shaped me into a person who is ready to face the working world.</p>
                </div>
              </div>
              <div className="absolute flex items-center justify-center left-[372px] top-0">
                <div className="flex-none rotate-[180deg] scale-y-[-1]">
                  <p className="font-['Raleway:ExtraLight',_sans-serif] font-extralight leading-[normal] relative text-[#980517] text-[160px] text-nowrap whitespace-pre">"</p>
                </div>
              </div>
              <div className="absolute flex items-center justify-center top-[213px] w-[58px]" style={{ left: "calc(50% - 29px)" }}>
                <div className="flex-none rotate-[180deg] scale-y-[-1]">
                  <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] relative text-[#980517] text-[20px] w-[58px]">Liana</p>
                </div>
              </div>
              <div className="absolute flex items-center justify-center top-[236px] w-[156px]" style={{ left: "calc(50% - 85px)" }}>
                <div className="flex-none rotate-[180deg] scale-y-[-1]">
                  <p className="font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] relative text-[#473f3d] text-[20px] w-[156px]">2025 - Graduate</p>
                </div>
              </div>
            </div>
            <div className="absolute border border-[#980517] border-solid inset-0 pointer-events-none rounded-[14px]" />
          </div>
        </div>
      </div>
      
      {/* Center testimonial text */}
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] text-[#473f3d] text-[20px] top-[401px] w-[293px]" style={{ left: "calc(50% - 146px)" }}>
        Horizon University Indonesia shaped me into a person who is ready to face the working world.
      </p>
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] text-[#980517] text-[20px] top-[526px] w-[46px]" style={{ left: "calc(50% - 23px)" }}>
        Ririn
      </p>
      <p className="absolute font-['Raleway:Medium',_sans-serif] font-medium leading-[normal] text-[#473f3d] text-[20px] top-[549px] w-[156px]" style={{ left: "calc(50% - 77px)" }}>
        2025 - Graduate
      </p>
      
      {/* Pagination Dots */}
      <div className="absolute size-[18px] top-[641px]" style={{ left: "calc(43.75% + 56px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#D9D9D9" r="9" />
        </svg>
      </div>
      <div className="absolute size-[18px] top-[641px]" style={{ left: "calc(50% - 9px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#980517" r="9" />
        </svg>
      </div>
      <div className="absolute size-[18px] top-[641px]" style={{ left: "calc(50% + 16px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#D9D9D9" r="9" />
        </svg>
      </div>
      <div className="absolute size-[18px] top-[641px]" style={{ left: "calc(50% + 41px)" }}>
        <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 18 18">
          <circle cx="9" cy="9" fill="#D9D9D9" r="9" />
        </svg>
      </div>
    </div>
  );
}

function FooterSection() {
  return (
    <div className="absolute bg-white h-[477px] left-0 overflow-hidden top-[3341px] w-[1440px]">
      <div className="absolute bg-[#7f0010] h-[330px] left-0 overflow-hidden top-[147px] w-[1440px]">
        <div className="absolute bg-[#d9d9d9] h-[2px] top-[257px] translate-x-[-50%] w-[1129px]" style={{ left: "calc(50% + 0.5px)" }} />
        
        {/* Copyright */}
        <div className="absolute flex items-center leading-[normal] left-1/2 text-nowrap text-white top-[284px] translate-x-[-50%] whitespace-pre">
          <p className="font-['Raleway:Medium',_sans-serif] font-medium relative text-[20px]">©</p>
          <p className="font-['Raleway:SemiBold',_sans-serif] font-semibold relative text-[16px]">2025, Horizon University Indonesia</p>
        </div>
        
        {/* Social Media */}
        <div className="absolute flex gap-[10px] items-center left-1/2 top-[202px] translate-x-[-50%]">
          {/* Instagram */}
          <div className="box-border flex gap-[10px] items-center p-[5px] relative rounded-[15px] size-[30px]">
            <div className="absolute border-2 border-[#f5e6e8] border-solid inset-0 pointer-events-none rounded-[15px]" />
            <div className="relative size-[20px]">
              <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
                <g>
                  <path d={svgPaths.p3dbfa400} fill="#F5E6E8" />
                </g>
              </svg>
            </div>
          </div>
          
          {/* Facebook */}
          <div className="box-border flex gap-[10px] items-center p-[5px] relative rounded-[15px] size-[30px]">
            <div className="absolute border-2 border-[#f5e6e8] border-solid inset-0 pointer-events-none rounded-[15px]" />
            <div className="relative size-[20px]">
              <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
                <g>
                  <path d={svgPaths.p2c54af00} fill="#F5E6E8" />
                </g>
              </svg>
            </div>
          </div>
          
          {/* TikTok */}
          <div className="box-border flex gap-[10px] items-center p-[5px] relative rounded-[15px] size-[30px]">
            <div className="absolute border-2 border-[#f5e6e8] border-solid inset-0 pointer-events-none rounded-[15px]" />
            <div className="relative size-[20px]">
              <svg className="block size-full" fill="none" preserveAspectRatio="none" viewBox="0 0 20 20">
                <g>
                  <path d={svgPaths.p17f15200} fill="#F5E6E8" />
                </g>
              </svg>
            </div>
          </div>
        </div>
        
        {/* Location */}
        <div className="absolute flex flex-col gap-[10px] items-start left-[920px] text-[#fdfdfd] text-[20px] top-[81px] w-[365px]">
          <p className="font-['Radio_Canada_Big:SemiBold',_sans-serif] font-semibold leading-[normal] relative w-full">Location</p>
          <div className="font-['Radio_Canada_Big:Regular',_sans-serif] font-normal leading-[normal] relative w-full">
            <p className="mb-0">Jl. Pangkal Perjuangan</p>
            <p>KM. 1 By Pass Karawang - Jawa Barat</p>
          </div>
        </div>
        
        {/* Contact Us */}
        <div className="absolute flex flex-col gap-[10px] items-start leading-[normal] left-[156px] text-[#fdfdfd] text-[20px] top-[81px] w-[212px]">
          <p className="font-['Radio_Canada_Big:SemiBold',_sans-serif] font-semibold relative w-full">CONTACT US</p>
          <p className="font-['Radio_Canada_Big:Regular',_sans-serif] font-normal relative w-full">0811-8454-800</p>
          <p className="font-['Radio_Canada_Big:Regular',_sans-serif] font-normal relative w-full">info.krw@horizon.ac.id</p>
        </div>
      </div>
    </div>
  );
}

export default function App() {
  return (
    <div className="bg-white relative w-[1440px] h-[3818px] mx-auto">
      <Header />
      <HeroSection />
      <GraduationScheduleSection />
      <StatisticsSection />
      <GraduationMediaSection />
      <TestimonialsSection />
      <FooterSection />
    </div>
  );
}