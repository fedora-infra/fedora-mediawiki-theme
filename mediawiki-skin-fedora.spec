
Name:           mediawiki-skin-fedora
Version:        0.11
Release:        1%{?dist}
Summary:        Fedora mediawiki skin

Group:          Applications/Internet
License:        GPLv2+
URL:            https://gitlab.com/fedora/websites-apps/themes/fedora-mediawiki-theme/
Source0:        https://gitlab.com/fedora/websites-apps/themes/fedora-mediawiki-theme/-/archive/v%{version}/fedora-mediawiki-theme-v%{version}.tar.gz

BuildArch:      noarch

Requires:       mediawiki

%description
The mediawiki skin for the Fedora Project wiki


%prep
%setup -q -n fedora-mediawiki-theme-v%{version}

%build

%install
mkdir -p %{buildroot}%{_datadir}/mediawiki/skins/
cp -a %{_builddir}/fedora-mediawiki-theme-v%{version}/Fedora/ %{buildroot}%{_datadir}/mediawiki/skins/


%files
%defattr(-,root,root,-)
%{_datadir}/mediawiki/skins/Fedora

%changelog
* Wed Jun 15 2022 Ryan Lerch <rlerch@redhat.com> - 0.11-1
- Tweak the spacing of the top bar to try to stop the login button wrapping
- Update to the new Fedora Logo

* Thu Jun 09 2022 Ryan Lerch <rlerch@redhat.com> - 0.10-1
- Update to v0.10
- At some point the Sanitizer module in mediawiki core removed the 
  Sanitizer::escapeId function. This was causing the theme to crash,
  so to fix this we use the Sanitizer::escapeIdForAttribute funtion 
  instead.

* Thu Oct 08 2020 Pierre-Yves Chibon <pingou@pingoured.fr> - 0.09-1
- Update to v0.09
- Fix the CoC link
- Show the last edit date at the top of the pages

* Wed Jun 26 2019 Kevin Fenzi <kevin@scrye.com> - 0.08-1
- Update to v0.08 to fix edit box and various other fixes.

* Fri Jan 04 2019 Kevin Fenzi <kevin@scrye.com> - 0.07-1
- Update to v0.07 to fix code of conduct in footer.

* Thu Jun 28 2018 Kevin Fenzi <kevin@scrye.com> - 0.06-1
- Rebuilt

* Wed Jan 03 2018 Patrick Uiterwijk <patrick@puiterwijk.org> - 0.05-1
- rebuilt

* Tue Nov 14 2017 Patrick Uiterwijk <patrick@puiterwijk.org> - 0.04-1
- rebuilt

* Tue Nov 14 2017 Patrick Uiterwijk <patrick@puiterwijk.org> - 0.03-1
- rebuilt

* Wed Oct 05 2016 Ryan Lerch <rlerch@redhat.com> - 0.02-1
- Inital version for Fedora 
