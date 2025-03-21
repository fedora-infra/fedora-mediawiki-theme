
Name:           mediawiki-skin-fedora
Version:        0.17
Release:        1%{?dist}
Summary:        Fedora mediawiki skin

Group:          Applications/Internet
License:        GPLv2+
URL:            https://github.com/fedora-infra/fedora-mediawiki-theme/
Source0:        https://github.com/fedora-infra/fedora-mediawiki-theme/archive/v%{version}/fedora-mediawiki-theme-%{version}.tar.gz

BuildArch:      noarch

Requires:       mediawiki

%description
The mediawiki skin for the Fedora Project wiki


%prep
%setup -q -n fedora-mediawiki-theme-%{version}

%build

%install
mkdir -p %{buildroot}%{_datadir}/mediawiki/skins/
cp -a %{_builddir}/fedora-mediawiki-theme-%{version}/Fedora/ %{buildroot}%{_datadir}/mediawiki/skins/


%files
%defattr(-,root,root,-)
%{_datadir}/mediawiki/skins/Fedora

%changelog
* Tue Mar 11 2025 Ryan Lerch <rlerch@redhat.com> - 0.17-1
- Fixes a regression where visited links were coloured the same
  as the body text.

* Thu Jan 30 2025 Ryan Lerch <rlerch@redhat.com> - 0.16-1
- Remove underline from links. Previously, the theme for the wiki 
  did not have any text decoration on links, but the recent 
  update to the newer Fedora Bootstrap added an underline to all 
  links in wikipages. This removes the underline on links.


* Wed Jan 15 2025 Ryan Lerch <rlerch@redhat.com> - 0.15-1
- Updated to latest Fedora Bootstrap version v5.3.3-0

* Fri May 17 2024 Ryan Lerch <rlerch@redhat.com> - 0.14-1
- Remove use of deprecated printTrail() method

* Thu May 18 2023 Ryan Lerch <rlerch@redhat.com> - 0.13-1
- Update to version v0.13 which fixes one issue:
- Turn on wikitables styling feature
  The mediawiki skinning interface removed the wikitables styling from
  being imported by default in 1.38. It can, however be re-enabled with a
  skin feature switch ('content-tables') which we do in this commit. See
  https://www.mediawiki.org/wiki/Manual:ResourceLoaderSkinModule

* Wed May 17 2023 Ryan Lerch <rlerch@redhat.com> - 0.12-1
- Update to version v0.12 which fixes one issue:
- in Mediawiki 1.36, the User->isLoggedIn() method was deprecated in
  favour of the method it wrapped: User->isRegistered(). isLoggedIn was
  subsequently removed in Mediawiki 1.38. In the Fedora mediawiki theme,
  we used isLoggedIn() in the main template to show or hide the login
  button and other elements for the logged in user. Consequently, the Fedora
  mediawiki theme was no longer working when trying to use on mediawiki later
  than 1.38. In this update, we now use the User->isRegistered() method
  which resolves this issue.

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
